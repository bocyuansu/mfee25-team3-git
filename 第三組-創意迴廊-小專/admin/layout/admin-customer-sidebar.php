<!-- side-bar -->
<div class="side-bar flex-shrink-0 p-3" style="width: 280px;height: calc(100vh - 106px);">
    <ul class="list-unstyled ps-0">
        <li class="side-button mb-1">
            <div class="active">
                <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                    會員管理
                </button>
            </div>
            <div class="collapse show" id="home-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="../Business/user-list.php" class="link-dark rounded ">賣家管理</a></li>
                    <li><a href="../Customer/customer-user-list.php" class="link-dark rounded active">消費者管理</a></li>
                </ul>
            </div>
        </li>
        <li class="side-button mb-1">
            <div class="">
                
                <a class="btn btn-toggle link-dark align-items-center rounded collapsed "  href="../Order/admin-order-list.php">訂單管理</a>
                
            </div>
        </li>
        
        <li class="side-button mb-1">
            <div class="">
                
                <a class="btn btn-toggle link-dark align-items-center rounded collapsed"  href="../Classify/admin-classify.php">種類管理</a>
                
            </div>
        </li>
        <li class="side-button mb-1">
            <div class="">
                <!-- <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false"> -->
                    <a class="btn btn-toggle link-dark align-items-center rounded collapsed"  href="">報表分析</a>
                <!-- </button> -->
            </div>
        </li>
        <li class="border-top my-3"></li>
    </ul>
</div>