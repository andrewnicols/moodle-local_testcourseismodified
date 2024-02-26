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
 * Provides access to protected methods we want to explicitly test
 *
 * @copyright 2023 Tomo Tsuyuki <tomotsuyuki@catalyst-au.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class testable_backup_cron_automated_helper extends \backup_cron_automated_helper {

    /**
     * Provides access to protected method is_course_modified.
     *
     * @param int $courseid course id to check
     * @param int $since timestamp, from which to check
     *
     * @return bool true if the course was modified, false otherwise. This also returns false if no readers are enabled. This is
     * intentional, since we cannot reliably determine if any modification was made or not.
     */
    public static function testable_is_course_modified($courseid, $since) {
        return parent::is_course_modified($courseid, $since);
    }
}
