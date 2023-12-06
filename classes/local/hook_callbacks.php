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

namespace local_testcourseismodified\local;

use core\hook\backup\get_exclude_course_backup_list;

/**
 * The local hook class.
 *
 * @package     local_testcourseismodified
 * @category    local
 * @copyright   2023 Tomo Tsuyuki <tomotsuyuki@catalyst-au.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class hook_callbacks {

    /**
     * Add array of event name to exclude to trigger course backup.
     * @param get_exclude_course_backup_list $hook
     * @return void
     */
    public static function get_exclude_course_backup_list(get_exclude_course_backup_list $hook): void {
        $hook->add_list([
            '\local_testcourseismodified\event\test_event_not_modified_one',
            '\local_testcourseismodified\event\test_event_not_modified_two',
        ]);
    }
}
