<!-- ##### Header Area Start ##### -->
<header class="header-area">
    <!-- Navbar Area -->
    <div class="palatin-main-menu">
        <div class="classy-nav-container breakpoint-off">
            <div class="container">
                <!-- Menu -->
                <nav class="classy-navbar justify-content-between" id="palatinNav">

                    <!-- Nav brand -->
                    <a href="<?= HOST_NAME ?>" class="nav-brand" style="width: 16%"><img src="<?= IMAGES_DIR ?>core-img/logo.png" alt=""></a>

                    <!-- Navbar Toggler -->
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>

                    <!-- Menu -->
                    <div class="classy-menu">

                        <!-- close btn -->
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>

                        <!-- Nav Start -->
                        <div class="classynav">
                            <ul>
                                <li class="<?= $this->Highlight('Default') ?>"><a href="<?= HOST_NAME ?>">Home</a></li>
                                <li class="<?= $this->Highlight('aboutus') ?>"><a href="<?= HOST_NAME ?>index/aboutus">About Us</a></li>
								<li class="<?= $this->Highlight('rooms') ?>"><a href="<?= HOST_NAME ?>index/rooms">Rooms</a></li>
                                <li class="<?= $this->Highlight('news') ?>"><a href="<?= HOST_NAME ?>index/news">News</a></li>
                                <li class="<?= $this->Highlight('contact') ?>"><a href="<?= HOST_NAME ?>index/contact">Contact</a></li>

                                <li class="menu-btn">
                                    <?php if (isset($_SESSION['loggedin'])) : ?>
                                        <?php if ($_SESSION['loggedin']->role != 'admin') : ?>
                                            <a href="#" id="sub-menu-btn"><?= $_SESSION['loggedin']->fullname ?></a>
                                            <ul class="dropdown">
                                                <li><a href="<?= HOST_NAME ?>user/reservations">Reservations</a></li>
                                                <li><a href="<?= HOST_NAME ?>user/messages">Messages</a></li>
                                                <li><a href="<?= HOST_NAME ?>user/profile">Profile</a></li>
                                                <li><a href="<?= HOST_NAME ?>user/signout">Sign Out</a></li>
                                            </ul>
                                        <?php else : ?>
                                            <a href="#" id="sub-menu-btn"><?= $_SESSION['loggedin']->fullname ?></a>
                                            <ul class="dropdown">
                                                <li><a href="<?= HOST_NAME ?>admin">Dashboard</a></li>
                                                <li><a href="<?= HOST_NAME ?>admin/signout">Sign Out</a></li>
                                            </ul>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <a href="<?= HOST_NAME ?>login" id="sub-menu-btn">Login/Register</a>
                                    <?php endif; ?>
                                </li>

                            </ul>

                        </div>
                        <!-- Nav End -->
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- ##### Header Area End ##### -->
<style>
    .menu-btn #sub-menu-btn {background-color: #cb8670;-webkit-transition-duration: 500ms;transition-duration: 500ms;padding: 0 30px;font-size: 16px;line-height: 53px;text-transform: capitalize;height: 53px;}
</style>