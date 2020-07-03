<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <!-- <a href="index.html"><img src="<?= base_url('assets/images/icon/logonew.png'); ?>"></a> -->
                    <h3 style="color: #fff;">CV.AINUN JAYA</h3>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <?php
                        $role_id = $this->session->userdata('role_id');
                        $queryMenu = "SELECT `user_menu`.`id`,`menu` 
                  From `user_menu` JOIN `user_access_menu`
                  on `user_menu`.`id`=`user_access_menu`.`menu_id`
                  where `user_access_menu`.`role_id`=$role_id
                  ORDER BY `user_access_menu`.`menu_id` ASC
                ";
                        $menu = $this->db->query($queryMenu)->result_array();
                        ?>
                        <ul class="metismenu" id="menu">
                            <?php foreach ($menu as $m) :
                                $menuId = $m['id'];
                                $querySubmenu = "SELECT * From `user_sub_menu` JOIN `user_menu` on `user_sub_menu`.`menu_id`=`user_menu`.`id` where `user_sub_menu`.`menu_id`=$menuId and `user_sub_menu`. `is_active`=1";
                                $submenu = $this->db->query($querySubmenu)->result_array();
                                if ($m['id'] == '2') : ?>
                                    <li class="active">
                                        <a href="<?= base_url('dashboard') ?>" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
                                    </li>
                                <?php elseif ($m['id'] == '5') : ?>
                                    <li>
                                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Master Data</span></a>
                                        <ul class="collapse">
                                            <?php foreach ($submenu as $sm) : ?>
                                                <?php if ($title == $sm['title']) : ?>
                                                    <li class="active">
                                                    <?php else : ?>
                                                    <li>
                                                    <?php endif; ?>
                                                    <a href="<?= base_url($sm['url']) ?>">
                                                        <i class="<?= $sm['icon'] ?>"></i> <span><?php echo $sm['title'] ?></span>
                                                    </a>
                                                    </li>
                                                <?php endforeach; ?>
                                        </ul>
                                    </li>
                                <?php elseif ($m['id'] == '6') : ?>
                                    <li>
                                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Transaksi</span></a>
                                        <ul class="collapse">
                                            <?php foreach ($submenu as $sm) : ?>
                                                <?php if ($title == $sm['title']) : ?>
                                                    <li class="active">
                                                    <?php else : ?>
                                                    <li>
                                                    <?php endif; ?>
                                                    <a href="<?= base_url($sm['url']) ?>">
                                                        <i class="<?= $sm['icon'] ?>"></i> <span><?php echo $sm['title'] ?></span>
                                                    </a>
                                                    </li>
                                                <?php endforeach; ?>
                                        </ul>
                                    </li>
                                <?php elseif ($m['id'] == '7') : ?>
                                    <li>
                                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Laporan</span></a>
                                        <ul class="collapse">
                                            <?php foreach ($submenu as $sm) : ?>
                                                <?php if ($title == $sm['title']) : ?>
                                                    <li class="active">
                                                    <?php else : ?>
                                                    <li>
                                                    <?php endif; ?>
                                                    <a href="<?= base_url($sm['url']) ?>">
                                                        <i class="<?= $sm['icon'] ?>"></i> <span><?php echo $sm['title'] ?></span>
                                                    </a>
                                                    </li>
                                                <?php endforeach; ?>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>

                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->