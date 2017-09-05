<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo base_url()?>assets/admin/img/user.jpg" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p><?php echo $adm->name;?></p>

            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li><a href="<?php echo $root_path;?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cubes"></i>
                    <span>Products</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo $root_path.'product/';?>"><i class="fa fa-list"></i> List Products</a></li>
                    <li><a href="<?php echo $root_path.'product/add/';?>"><i class="fa fa-plus"></i> Add New Product</a></li>
                    <li><a href="<?php echo $root_path.'category/';?>"><i class="fa fa-server"></i> Product Category </a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-file-text-o"></i>
                    <span>Orders</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo $root_path.'order/';?>"><i class="fa fa-copy"></i> List Orders</a></li>
                    <li><a href="<?php echo $root_path.'order/payment';?>"><i class="fa fa-credit-card"></i> payment</a></li>
                    <li><a href="<?php echo $root_path.'inquiry';?>"><i class="fa fa-star"></i> Inquiry</a></li>
                    <li><a href="<?php echo $root_path.'order/testimoni';?>"><i class="fa fa-comment-o"></i> Testimoni</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Customers</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo $root_path.'customer/';?>"><i class="fa fa-list"></i> List Customers</a></li>
                    <li><a href="<?php echo $root_path.'newsletter/';?>"><i class="fa fa-envelope"></i> Newsletter</a></li>
                </ul>
            </li>
            <li><a href="<?php echo $root_path.'page/';?>"><i class="fa fa-columns"></i> Static Pages</a></li>
            <li><a href="<?php echo $root_path.'banner/';?>"><i class="fa fa-file-photo-o"></i> Banners</a></li>
            <li><a href="<?php echo $root_path.'marketplace/';?>"><i class="fa fa-file-photo-o"></i> MarketPlace</a></li>
            <li><a href="<?php echo $root_path.'ads/';?>"><i class="fa fa-volume-up"></i> Ads</a></li>
            <li><a href="<?php echo $root_path.'admin/';?>"><i class="fa fa-user"></i> Administrator</a></li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gears"></i>
                    <span>Configuration</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo $root_path.'config/site/';?>"><i class="fa fa-home"></i> Site</a></li>
                    <li><a href="<?php echo $root_path.'config/contact/';?>"><i class="fa fa-newspaper-o"></i> Contact</a></li>
                    <li><a href="<?php echo $root_path.'config/socmed/';?>"><i class="fa fa-share-alt"></i> Social Media</a></li>
                    <li><a href="<?php echo $root_path.'account/';?>"><i class="fa fa-bank"></i> ATM & Bank</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Daerah & Ongkir</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo $root_path.'province';?>"><i class="fa fa-circle-o"></i> Provinsi</a></li>
                    <li><a href="<?php echo $root_path.'city';?>"><i class="fa fa-circle-o"></i> Kota</a></li>
                    <li><a href="<?php echo $root_path.'kecamatan';?>"><i class="fa fa-circle-o"></i> Kecamtan & Ongkir</a></li>
                </ul>
            </li>

<!--             <li class="treeview">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Master</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="../layout/top-nav.html"><i class="fa fa-circle-o"></i> Manufacture</a></li>
                    <li><a href="../layout/boxed.html"><i class="fa fa-circle-o"></i> Spare Part</a></li>
                    <li><a href="../layout/boxed.html"><i class="fa fa-circle-o"></i> User</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Documents</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="../charts/morris.html"><i class="fa fa-circle-o"></i>All Document</a></li>
                    <li><a href="../charts/flot.html"><i class="fa fa-circle-o"></i> Unchecked</a></li>
                    <li><a href="../charts/inline.html"><i class="fa fa-circle-o"></i> Unsigned</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Find Documents</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="../charts/morris.html"><i class="fa fa-circle-o"></i>By Date</a></li>
                    <li><a href="../charts/flot.html"><i class="fa fa-circle-o"></i> By User</a></li>
                    <li><a href="../charts/inline.html"><i class="fa fa-circle-o"></i> By Attribute</a></li>
                    <li><a href="../charts/inline.html"><i class="fa fa-circle-o"></i> Advance Search</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>Activity</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="../tables/simple.html"><i class="fa fa-circle-o"></i> My Activity</a></li>
                    <li><a href="../tables/data.html"><i class="fa fa-circle-o"></i> All Users</a></li>
                </ul>
            </li>
            <li>
                <a href="../calendar.html">
                    <i class="fa fa-calendar"></i> <span>Configuration</span>
                    <small class="label pull-right bg-red">3</small>
                </a>
            </li> -->
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>