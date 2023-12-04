<?php
// This file is part of Moodle - http://moodle.org/
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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Library of interface functions and constants.
 *
 * @package     local_testcourseismodified
 * @copyright   2023 Tomo Tsuyuki <tomotsuyuki@catalyst-au.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Return array of event name to exclude to trigger course backup.
 *
 * @return array
 */
function local_testcourseismodified_get_exclude_course_backup_list(): array {
    return [
        '\local_testcourseismodified\event\test_event_not_modified_one',
        '\local_testcourseismodified\event\test_event_not_modified_two',
        ];
}
