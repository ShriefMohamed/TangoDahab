<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="<?= HOST_NAME ?>admin"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>

                    <h3 class="menu-title">Financial & Management</h3>
<!--                    <li class="menu-item-has-children dropdown">-->
<!--                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Financial Summary</a>-->
<!--                        <ul class="sub-menu children dropdown-menu">-->
<!--                            <li><i class="fa fa-id-badge"></i><a href="admin/financialsummary">Financial Summary</a></li>-->
<!--                        </ul>-->
<!--                    </li>-->

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Rooms Management</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-id-badge"></i><a href="<?= HOST_NAME ?>admin/rooms">All Rooms</a></li>
                            <li><i class="fa fa-id-badge"></i><a href="<?= HOST_NAME ?>admin/activerooms">Active Rooms</a></li>
                            <li><i class="fa fa-id-badge"></i><a href="<?= HOST_NAME ?>admin/inactiverooms">Inactive Rooms</a></li>
                            <li><i class="fa fa-id-badge"></i><a href="<?= HOST_NAME ?>admin/reservedrooms">Reserved Rooms</a></li>
                            <li><i class="fa fa-id-badge"></i><a href="<?= HOST_NAME ?>admin/emptyrooms">Empty Rooms</a></li>
                            <li><i class="fa fa-id-badge"></i><a href="<?= HOST_NAME ?>admin/newroom">Add New Room</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Reservations</a>
                        <ul class="sub-menu children dropdown-menu">

                            <li><i class="fa fa-id-badge"></i><a href="<?= HOST_NAME ?>admin/reservations">Reservations</a></li>
                            <li><i class="fa fa-id-badge"></i><a href="<?= HOST_NAME ?>admin/newreservation">Add Reservation</a></li>

                        </ul>
                    </li>





                    <h3 class="menu-title">Users Management</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Users (Customers/Admin)</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-id-badge"></i><a href="<?= HOST_NAME ?>admin/manageusers">Manage All Users</a></li>
                            <li><i class="fa fa-id-badge"></i><a href="<?= HOST_NAME ?>admin/managecustomers">Manage Customers</a></li>
                            <li><i class="fa fa-id-badge"></i><a href="<?= HOST_NAME ?>admin/manageadmins">Manage Admins</a></li>
                            <li><i class="fa fa-id-badge"></i><a href="<?= HOST_NAME ?>admin/adduser">Add User</a></li>
                        </ul>
                    </li>


                    <h3 class="menu-title">Customers Support</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Messages</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-id-badge"></i><a href="<?= HOST_NAME ?>admin/messages">Received Messages</a></li>
                            <li><i class="fa fa-id-badge"></i><a href="<?= HOST_NAME ?>admin/sentmessages">Sent Messages</a></li>
                            <li><i class="fa fa-id-badge"></i><a href="<?= HOST_NAME ?>admin/newmessage">New Message</a></li>
                        </ul>
                    </li>


                    <h3 class="menu-title">News Management</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>News</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-id-badge"></i><a href="<?= HOST_NAME ?>admin/news">All News</a></li>
                            <li><i class="fa fa-id-badge"></i><a href="<?= HOST_NAME ?>admin/addnews">Add New Post</a></li>
                        </ul>
                    </li>


                    <h3 class="menu-title">Website Management</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Manage Website</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-id-badge"></i><a href="<?= HOST_NAME ?>admin/paymentoption">Not Paying Option</a></li>
                            <li><i class="fa fa-id-badge"></i><a href="<?= HOST_NAME ?>admin/subscribers">Subscribers</a></li>
                            <li><i class="fa fa-id-badge"></i><a href="<?= HOST_NAME ?>admin/contactinfo">Contact Info</a></li>

                            <li><i class="fa fa-id-badge"></i><a href="<?= HOST_NAME ?>admin/aboutus">About Us</a></li>
                            <li><i class="fa fa-id-badge"></i><a href="<?= HOST_NAME ?>admin/aboutus1">Homepage About Us #1</a></li>
                            <li><i class="fa fa-id-badge"></i><a href="<?= HOST_NAME ?>admin/aboutus2">Homepage About Us #2</a></li>
                            <li><i class="fa fa-id-badge"></i><a href="<?= HOST_NAME ?>admin/aboutus3">Homepage About Us #3</a></li>
                            <li><i class="fa fa-id-badge"></i><a href="<?= HOST_NAME ?>admin/termsconditions">Terms & Conditions</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Testimonials</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-id-badge"></i><a href="<?= HOST_NAME ?>admin/managetestimonials">Manage Testimonials</a></li>
                            <li><i class="fa fa-id-badge"></i><a href="<?= HOST_NAME ?>admin/addtestimonials">Add Testimonial</a></li>
                        </ul>
                    </li>

                    <h3 class="menu-title">Admin</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Logged In Admin</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-id-badge"></i><a href="<?= HOST_NAME ?>admin/profile">Profile</a></li>
                            <li><i class="fa fa-id-badge"></i><a href="<?= HOST_NAME ?>admin/signout">Sign Out</a></li>
                        </ul>
                    </li>                    

                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->
    <!-- Left Panel -->
