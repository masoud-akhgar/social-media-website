<header>
    <div class="bg-primary-myself shadow-bottom">
        <div class="container d-flex header">
            <div class="logo col-2">
                <p class="mt-3 text-white">Our Social Network !</p>
            </div>
            <div class="asset col-5 text-left">
                <ul class="nav d-flex h-100 mb-0 pb-0">
                    <li class="nav-item">
                        <a href="main.php" class="nav-link text-white "> <img class="profile-header" src="asset/images/home.png" alt=""></a>
                    </li>
                </ul>
            </div>
            <div class="text-left col-7">
                <ul class="nav d-flex">
                    <li class="nav-item">
                        <a href="" class="nav-link text-white"><img class="profile-header" src="asset/images/plus.png" alt=""></a>
                    </li>

                    <li class="nav-item">
                        <a href="" class="nav-link text-white"><img class="profile-header" src="asset/images/icons8-notification-24.png" alt=""></a>
                    </li>
                    <li class="nav-item">
                        <a href="profile.php" class="nav-link text-white">
                            <?
                            $userid = $_SESSION['UserID'];
                            $userProfile = $mysql->Execute("SELECT * FROM sadaf.profile WHERE userId=$userid");
                            $user = $userProfile->fetch();
                            ?>
                            <div class="d-flex"><img class="profile-header" src="<?echo $user['profileimage']?>">
                                <p class="mt-2 ml-1 text-white"> <?echo $_SESSION['username']?></p>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link text-white"><img src="asset/images/icons8-menu-vertical-50.png" class="w-50 mt-2"></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>