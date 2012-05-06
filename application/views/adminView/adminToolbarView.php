<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<div class="leftFloat" id="toolbar">
    <h4>Notification</h4>
    <div>
        <p>Nothing!</p>
    </div>
    <h4>Tools</h4>
    <div>
        <p><?=anchor('adminController/uploadBookList','Upload book list','title="Upload New List"'); ?></p>
        <p><?=anchor('adminController/viewApprovedList','View Approved List','title="View Approved List"'); ?></p>
        <p><?=anchor('adminController/viewAllUsers','List of Lect/HOD','title="List of Lect/HOD"'); ?></p>
        <p><?=anchor('adminController/participatedUsers','Participated Lect.','title="Lecturers who respond"'); ?></p>
        <p><?=anchor('adminController/nonParticipatedUsers','Unparticipated Lect.','title="Lecturers Who didnt respond"'); ?></p>
    </div>
</div>
