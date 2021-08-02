<div class="sidemenu">
    <ul class="sidemenu-tab">
        <li class="<?php ($data ['page'] === 'index') ? 'active' : '' ?>">
            <a href="<?= URLROOT ?>/cms">
                <div class="sidetab-element"><i class="fas fa-home"></i>&nbsp;Dashboard</div>
            </a>
        </li>
        <li class="<?php ($data ['page'] === 'new_genre') ? 'active' : '' ?>">
            <a href="<?= URLROOT ?>/cms/new_genre">
                <div class="sidetab-element"><i class="fas fa-pencil-alt"></i>&nbsp;Add New Genre</div>
            </a>
        </li>
        <li class="<?php ($data ['page'] === 'music_release') ? 'active' : '' ?>">
            <a href="<?= URLROOT ?>/cms/music_release">
                <div class="sidetab-element"><i class="fas fa-chess-bishop"></i>&nbsp;&nbsp;&nbsp;In Your Head</div>
            </a>
        </li>
        <li class="<?php ($data ['page'] === 'manage_admin') ? 'active' : '' ?>">
            <a href="<?= URLROOT ?>/cms/manage_admins">
                <div class="sidetab-element"><i class="far fa-user-plus"></i>Manage Admins</div>
            </a>
        </li>
        <li class="<?php ($data ['page'] === 'comments') ? 'active' : '' ?>">
            <a href="<?= URLROOT ?>/cms/comments">
                <div class="sidetab-element"><i class="fas fa-comments"></i>&nbsp;Comments</div>
            </a>
        </li>
        <li class="<?php ($data ['page'] === 'manage_ads') ? 'active' : '' ?>">
            <a href="<?= URLROOT ?>/cms/manage_ads">
                <div class="sidetab-element"><i class="fas fa-ad"></i>&nbsp;Manage Ads</div>
            </a>
        </li>
        <li>
            <a href="<?= URLROOT ?>">
                <div class="sidetab-element"><i class="far fa-eye"></i>&nbsp;Live Preview</div>
            </a>
        </li>
        <li>
            <a href="<?= URLROOT ?>/users/logout">
                <div class="sidetab-element"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</div>
            </a>
        </li>
    </ul>
</div>