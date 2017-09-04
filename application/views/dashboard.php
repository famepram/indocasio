<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $page_name;?></title>
        <?php include('inc/load_top.php');?>
        <link href="<?php echo base_url();?>assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css">
    </head>
    <body class="skin-blue">
        <div class="wrapper">
            <!-- header. contains the top menu-->
            <?php include('inc/header.php');?>
            <!-- Left side column. contains the logo and sidebar -->
            <?php include('inc/sidebar.php');?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1> Dashboard<small>Control panel</small> </h1>
                    <ol class="breadcrumb">
                        <li class="active"><i class="fa fa-dashboard"></i>&nbsp; Dashboard</li>
                    </ol>
                </section>

                  <!-- Main content -->
                <section class="content">
                        <!-- =========================================================== -->

                      <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div onclick="window.location='<?php echo $this->_root_path;?>order/';" class="col-lg-3 col-xs-6">
                            <!-- small box -->
                              
                            <div class="small-box bg-aqua dashboard-menu">
                                <div class="inner">
                                    <h3><?php echo $this->_order->get_new_order_num();?></h3>
                                    <p>Jumlah Order Baru</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-shopping-cart"></i>
                                </div>
                                <a href="<?php echo $this->_root_path;?>order/" class="small-box-footer">
                                    View List Orders <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
               
                        </div><!-- ./col -->
                        <div onclick="window.location='<?php echo $this->_root_path;?>customer/';" class="col-lg-3 col-xs-6 dashboard-menu">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3><?php echo $this->_customer->get_total();?></h3>
                                    <p>Customer Terdaftar</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-users"></i>
                                </div>
                                <a href="<?php echo $this->_root_path;?>customer/" class="small-box-footer">
                                    View List Customer <i class="fa fa-arrow-circle-right"></i>
                                </a>
                              </div>
                        </div><!-- ./col -->
                        <div onclick="window.location='<?php echo base_url();?>product/';" class="col-lg-3 col-xs-6 dashboard-menu">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3><?php echo $this->_product->get_total();?></h3>
                                    <p>Total Produk</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-cube"></i>
                                </div>
                                <a href="<?php echo base_url();?>product/" class="small-box-footer">
                                    View List Product <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6 dashboard-menu">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>40</h3>
                                    <p>Jumlah Pengunjung</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-user"></i>
                                </div>
                                <a href="#" class="small-box-footer" onclick="javascript:void(0);" >
                                    Based Google Analytic
                                </a>
                            </div>
                        </div><!-- ./col -->
                    </div><!-- /.row -->

                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="box box-solid bg-teal-gradient">
                                <div class="box-header">
                                    <i class="fa fa-th"></i>
                                    <h3 class="box-title">Sales Graph</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <!-- <button class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i></button> -->
                                    </div>
                                </div>
                                <div class="box-body border-radius-none">
                                    <div class="chart" id="line-chart" style="height: 250px;"></div>
                                </div><!-- /.box-body -->

                            </div><!-- /.box -->
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="box box-solid bg-green-gradient">
                                <div class="box-header">
                                    <i class="fa fa-th"></i>
                                    <h3 class="box-title">Seminggu terakhir pengunjung</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn bg-green btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                       <!--  <button class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i></button> -->
                                    </div>
                                </div>
                                <div class="box-body border-radius-none">
                                    <div class="chart" id="line-chart-visitor" style="height: 250px;"></div>
                                </div><!-- /.box-body -->

                            </div><!-- /.box -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="box box-info">
                                <div class="box-header with-border">
                                  <h3 class="box-title">Latest 5 Orders</h3>
                                  <div class="box-tools pull-right">
                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                  </div>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table class="table no-margin">
                                            <thead>
                                                <tr>
                                                    <th>Order ID</th>
                                                    <th>Buyer</th>
                                                    <th>Total Buy</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $olist = $this->_order->get_all(5);?>
                                                <?php if(!empty($olist)):?>
                                                    <?php foreach($olist as $o):?>
                                                    <tr>
                                                        <td><a href="<?php echo $this->_root_path.'order/view/'.$o->id;?>"><?php echo $o->get_no_order();?></a></td>
                                                        <td><?php echo $o->fname.' '.$o->lname;?></td>
                                                        <td><?php echo 'IDR '.number_format($o->total_cost);?></td>
                                                        <td>
                                                            <?php if($o->status == 0):?>
                                                            <label class="label label-default"><?php echo get_status_order($o->status);?></label>
                                                            <?php elseif($o->status == 1):?>
                                                            <label class="label label-default"><?php echo get_status_order($o->status);?></label>
                                                            <?php elseif($o->status == 2):?>
                                                            <label class="label label-warning"><?php echo get_status_order($o->status);?></label>
                                                            <?php elseif($o->status == 3):?>
                                                            <label class="label label-success"><?php echo get_status_order($o->status);?></label>
                                                            <?php elseif($o->status == 4):?>
                                                            <label class="label label-success"><?php echo get_status_order($o->status);?></label>
                                                            <?php elseif($o->status == 5):?>
                                                            <label class="label label-success"><?php echo get_status_order($o->status);?></label>
                                                            <?php elseif($o->status == 6):?>
                                                            <label class="label label-danger"><?php echo get_status_order($o->status);?></label>
                                                            <?php endif;?>
                                                        </td>
                                                        <td><a class="btn btn-info" href=""> <span class="fa fa-search"></span></a></td>
                                                    </tr>
                                                    <?php endforeach;?>
                                                <?php else :?>
                                                <tr>
                                                    <td colspan="5">No Orders</td>
                                                </tr>
                                                <?php endif;?>
                                            </tbody>
                                        </table>
                                    </div><!-- /.table-responsive -->
                                </div><!-- /.box-body -->
                                <div class="box-footer clearfix">
                                    <a href="<?php echo $this->_root_path.'product/';?>" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
                                </div><!-- /.box-footer -->
                            </div><!-- /.box -->

                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="box box-info">
                                <div class="box-header with-border">
                                  <h3 class="box-title">5 Top Products</h3>
                                  <div class="box-tools pull-right">
                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                  </div>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table class="table no-margin">
                                            <thead>
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Category</th>
                                                    <th>Qty <br>Order</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $plist = $this->_product->get_top_products(5);?>
                                                <?php if(!empty($plist)):?>
                                                    <?php foreach($plist as $p):?>
                                                    <tr>
                                                        <td><img src="<?php echo $p->get_img_src(true);?>" style="width:48px;"></td>
                                                        <td><a href="<?php echo $this->_root_path.'product/update/'.$p->id;?>"><?php echo $p->code;?></a></td>
                                                        <td><small><?php echo $p->get_cat_str();?></small></td>
                                                        <td><?php echo $p->total;?></td>
                                                        <td>
                                                        </td>
                                                        <td><a class="btn btn-info" href=""> <span class="fa fa-search"></span></a></td>
                                                    </tr>
                                                    <?php endforeach;?>
                                                <?php else :?>
                                                <tr>
                                                    <td colspan="5">No Top Product</td>
                                                </tr>
                                                <?php endif;?>
                                            </tbody>
                                        </table>
                                    </div><!-- /.table-responsive -->
                                </div><!-- /.box-body -->
                                <div class="box-footer clearfix">
                                    <!-- <a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a> -->
                                    <a href="<?php echo $this->_root_path.'product/';?>" class="btn btn-sm btn-default btn-flat pull-right">View All Products</a>
                                </div><!-- /.box-footer -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                    <!-- =========================================================== -->
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                      <b>Version</b> 2.0
                </div>
                <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
            </footer>
        </div><!-- ./wrapper -->
        <?php include('inc/load_bottom.php');?>
        <!-- Morris -->
        <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="<?php echo base_url();?>assets/admin/plugins/morris/morris.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                /* 
                    data: [
                      {y: '2011 Q1', item1: 2666},
                      {y: '2011 Q2', item1: 2778},
                      {y: '2011 Q3', item1: 4912},
                      {y: '2011 Q4', item1: 3767},
                      {y: '2012 Q1', item1: 6810},
                      {y: '2012 Q2', item1: 5670},
                      {y: '2012 Q3', item1: 4820},
                      {y: '2012 Q4', item1: 15073},
                      {y: '2013 Q1', item1: 10687},
                      {y: '2013 Q2', item1: 8432}
                    ]

                */
                var data_morris = JSON.parse('<?php echo json_encode($this->_order->get_morris_chart_data());?>');
                console.log(data_morris);
                var line = new Morris.Line({
                    element: 'line-chart',
                    resize: true,
                    data: data_morris,
                    hoverCallback: function(index, options, content) {
                        return(content);
                    },
                    xkey: 'y',
                    ykeys: ['item1'],
                    labels: ['Total Sales'],
                    lineColors: ['#efefef'],
                    lineWidth: 2,
                    parseTime:false,
                    hideHover: 'auto',
                    gridTextColor: "#fff",
                    gridStrokeWidth: 0.4,
                    pointSize: 1,
                    pointStrokeColors: ["#efefef"],
                    gridLineColor: "#efefef",
                    gridTextFamily: "Open Sans",
                    gridTextSize: 10
                });
                //Donut Chart
                  // var donut = new Morris.Donut({
                  //   element: 'sales-chart',
                  //   resize: true,
                  //   colors: ["#3c8dbc", "#f56954", "#00a65a"],
                  //   data: [
                  //     {label: "Download Sales", value: 12},
                  //     {label: "In-Store Sales", value: 30},
                  //     {label: "Mail-Order Sales", value: 20}
                  //   ],
                  //   hideHover: 'auto'
                  // });

                var line = new Morris.Line({
                    element: 'line-chart-visitor',
                    resize: true,
                    data: [
                      {y: '2011 Q1', item1: 2666},
                      {y: '2011 Q2', item1: 2778},
                      {y: '2011 Q3', item1: 4912},
                      {y: '2011 Q4', item1: 3767},
                      {y: '2012 Q1', item1: 6810},
                      {y: '2012 Q2', item1: 5670},
                      {y: '2012 Q3', item1: 4820},
                      {y: '2012 Q4', item1: 15073},
                      {y: '2013 Q1', item1: 10687},
                      {y: '2013 Q2', item1: 8432}
                    ],
                    
                    xkey: 'y',
                    ykeys: ['item1'],
                    labels: ['Item 1'],
                    lineColors: ['#efefef'],
                    lineWidth: 2,
                    hideHover: 'auto',
                    gridTextColor: "#fff",
                    gridStrokeWidth: 0.4,
                    pointSize: 4,
                    pointStrokeColors: ["#efefef"],
                    gridLineColor: "#efefef",
                    gridTextFamily: "Open Sans",
                    gridTextSize: 10
                  });


            });
        </script>
        
    </body>
</html>
