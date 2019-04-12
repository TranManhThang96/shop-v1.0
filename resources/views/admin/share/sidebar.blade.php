<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
                </ul>
            </li>

            <li>
                <a href="{{route('categories.index')}}">
                    <i class="fa fa-th"></i> <span>Danh Mục</span>
                    <span class="pull-right-container">
              <small class="label pull-right bg-green">{{$shareData['countCate']}}</small>
            </span>
                </a>
            </li>

            <li>
                <a href="{{route('admin.product.index')}}">
                    <i class="fa fa-th"></i> <span>Sản phẩm</span>
                    <span class="pull-right-container">
              <small class="label pull-right bg-green">{{$shareData['countPro']}}</small>
            </span>
                </a>
            </li>

            <li>
                <a href="{{route('brands.index')}}">
                    <i class="fa fa-th"></i> <span>Đơn hàng</span>
                    <span class="pull-right-container">
              <small class="label pull-right bg-green">{{$shareData['countBrand']}}</small>
            </span>
                </a>
            </li>

            <li>
                <a href="{{route('brands.index')}}">
                    <i class="fa fa-th"></i> <span>Hóa đơn nhập</span>
                    <span class="pull-right-container">
              <small class="label pull-right bg-green">{{$shareData['countBrand']}}</small>
            </span>
                </a>
            </li>


            <li>
                <a href="{{route('brands.index')}}">
                    <i class="fa fa-th"></i> <span>Hóa đơn xuất</span>
                    <span class="pull-right-container">
              <small class="label pull-right bg-green">{{$shareData['countBrand']}}</small>
            </span>
                </a>
            </li>

            <li>
                <a href="{{route('admin.customer.list')}}">
                    <i class="fa fa-th"></i> <span>Khách hàng</span>
                    <span class="pull-right-container">
              <small class="label pull-right bg-green">{{$shareData['countCustomer']}}</small>
            </span>
                </a>
            </li>

            <li>
                <a href="{{route('admin.discount.list')}}">
                    <i class="fa fa-th"></i> <span>Chương trình khuyến mại</span>
                    <span class="pull-right-container">
              <small class="label pull-right bg-green">{{$shareData['countDiscount']}}</small>
            </span>
                </a>
            </li>

            <li>
                <a href="{{route('brands.index')}}">
                    <i class="fa fa-th"></i> <span>Thương hiệu</span>
                    <span class="pull-right-container">
              <small class="label pull-right bg-green">{{$shareData['countBrand']}}</small>
            </span>
                </a>
            </li>

            <li>
                <a href="{{route('suppliers.index')}}">
                    <i class="fa fa-th"></i> <span>Nhà cung cấp</span>
                    <span class="pull-right-container">
              <small class="label pull-right bg-green">{{$shareData['countSupplier']}}</small>
            </span>
                </a>
            </li>

            <li>
                <a href="{{route('posts.index')}}">
                    <i class="fa fa-th"></i> <span>Bài viết</span>
                    <span class="pull-right-container">
              <small class="label pull-right bg-green">{{$shareData['countDiscount']}}</small>
            </span>
                </a>
            </li>


            <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>