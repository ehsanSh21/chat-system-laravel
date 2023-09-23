<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="{{route('admin.user.index')}}">
                    <i class="fas fa-home"></i>
                    All Admins
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{route('admin.user.create')}}">
                    <i class="fas fa-home"></i>
                    Create Admin
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{route('admin.chat')}}">
                    <i class="fas fa-home"></i>
                    Chat
{{--                    <span style="border-radius: 50%;color: linen" class="bg-danger px-2 py-1">{{$notRead}}</span>--}}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.blog.index')}}">
                    <i class="fas fa-file-image"></i>
                     All blogs
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.blog.create')}}">
                    <i class="fas fa-file-image"></i>
                    Create Blogs
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.product.index')}}">
                    <i class="fas fa-file-image"></i>
                    All products
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.product.create')}}">
                    <i class="fas fa-file-image"></i>
                    Create Product
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.products.generate')}}">
                    <i class="fas fa-file-image"></i>
                    Generate discount code
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.products.orders')}}">
                    <i class="fas fa-file-image"></i>
                    Orders
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.products.bestSellingProducts')}}">
                    <i class="fas fa-file-image"></i>
                    Best Selling Products
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="category.php">
                    <i class="fas fa-folder-open"></i>
                    دسته بندی
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="comment.php">
                    <i class="fas fa-comments"></i>
                    کامنت
                </a>
            </li>

        </ul>

    </div>
</nav>
