<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

namespace local_testcourseismodified;

/**
 * The coursebackup test class.
 *
 * @package     local_testcourseismodified
 * @category    test
 * @copyright   2023 Tomo Tsuyuki <tomotsuyuki@catalyst-au.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class courseismodified_test extends \advanced_testcase {
    public static function setUpBeforeClass(): void {
        global $CFG;

        require_once($CFG->dirroot . '/backup/util/helper/backup_cron_helper.class.php');
        require_once($CFG->dirroot . '/local/testcourseismodified/tests/testable_backup_cron_automated_helper.php');
    }

    /**
     * Function is_course_modified test.
     *
     * @covers \backup_cron_automated_helper::is_course_modified
     */
    public function test_is_course_modified(): void {
        $this->resetAfterTest();
        $this->preventResetByRollback();

        set_config('enabled_stores', 'logstore_standard', 'tool_log');
        set_config('buffersize', 0, 'logstore_standard');
        set_config('logguests', 1, 'logstore_standard');

        $course = $this->getDataGenerator()->create_course();

        // New courses should be backed up.
        $this->assertTrue(testable_backup_cron_automated_helper::testable_is_course_modified($course->id, 0));

        // Ignore if the event is defined in the get_exclude_course_backup_list callback.
        $timepriortobackup = time();
        $this->waitForSecond();
        $event = \local_testcourseismodified\event\test_event_not_modified_one::create([
            'objectid' => $course->id,
            'context'  => \core\context\course::instance($course->id),
            'other'    => [],
        ]);
        $event->trigger();
        $this->assertFalse(testable_backup_cron_automated_helper::testable_is_course_modified($course->id, $timepriortobackup));

        $event = \local_testcourseismodified\event\test_event_not_modified_two::create([
            'objectid' => $course->id,
            'context'  => \core\context\course::instance($course->id),
            'other'    => [],
        ]);
        $event->trigger();
        $this->assertFalse(testable_backup_cron_automated_helper::testable_is_course_modified($course->id, $timepriortobackup));

        $event = \local_testcourseismodified\event\test_event_modified_one::create([
            'objectid' => $course->id,
            'context'  => \core\context\course::instance($course->id),
            'other'    => [],
        ]);
        $event->trigger();
        $this->assertTrue(testable_backup_cron_automated_helper::testable_is_course_modified($course->id, $timepriortobackup));
    }
}
