<!-- This file functions between the header and footer, there is no need for HTML or body tags. -->
<ul>
 <li <?php if ($active['home']) { ?> class="active" <?php } ?>><a href="<?= base_url(); ?>index.php?/Home">Home</a></li>
 <li <?php if ($active['members']) { ?> class="active" <?php } ?>><a href="<?= base_url(); ?>index.php?/Members">Members</a></li>
 <li <?php if ($active['editors']) { ?> class="active" <?php } ?>><a href="<?= base_url(); ?>index.php?/Editors">Editors</a></li>
 <li <?php if ($active['admin']) { ?> class="active" <?php } ?>><a href="<?= base_url(); ?>index.php?/Admin">Admin</a></li>
 <?php if ($loggedin) { ?>
 <li><a href="<?= base_url(); ?>index.php?/Login/logout">Logout</a></li>
 <?php } else { ?>
 <li <?php if ($active['login']) { ?> class="active" <?php } ?>><a href="<?= base_url(); ?>index.php?/Login">Login</a></li>
 <?php } ?>
</ul>
