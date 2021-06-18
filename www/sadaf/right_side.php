<script src="right_script.js"></script>
<div class="col-2 shadow-left ml-3 pt-2" style="margin-top: 82px; background-color: #f6f6f6;top:-20px;height: 900px;position: fixed;">
            <div class="text-left">
                <p class=" d-inline titer">Chat</p>
            </div>
            <div class="d-flex shadow-bottom shadow-left py-3 bg-white" id="online">
                <div class="d-flex">
                    <button class="btn hover-primary"> online <img src="./images/eye.png" style="width: 20px;"> </button>
                </div>
                <div class="d-flex">
                    <button class="btn hover-primary">offline <img src="./images/invisible.png" style="width: 20px;"> </button>
                </div>
            </div>
            <div class=" mt-2"> 
                <div>
                    <!-- <input placeholder="search for users" class="w-100 py-1 text-left bg-dark-25 border-none pl-3">  -->
                    <div class="search-box" style="margin-right: 20px">
                        <form action="" method="GET">
                            <input type="text" name="query" placeholder="search for users" class="w-100 py-1 text-left bg-dark-25 border-none pl-3" />
                            <input type="submit" name="submit" value="Search" />
                        </form>
                    </div>

                    <?php

                    if(isset($_GET['submit'])){
                        if(empty($_GET['query'])){
                            echo "Enter a search term";
                        }

                        $query=$_GET['query'];
                        $mysql = pdodb::getInstance();
                        $res = $mysql->Execute("select * from sadaf.user where username like '%$query%' ");

                        while($rec = $res->fetch()) {
        //                    echo "<div> ". $rec['username'] ." </div>";
                            echo "<div class='d-flex mt-2'>
                                    <div class='col-9'>
                            
                            <p class='mt-1'>". $rec['username'] ."</p>
                        </div>


                        <div class='w-25' style='left: 0;'>
                            <a href='profile.html'><img src='./images/face1.jpg' class='w-100'></a>
                            <div class='bg-danger' style='position: absolute;margin-top:-50;border-radius: 50%;width:15px;height: 15px'>
                                <p style='font-size: 12px;' class='ml-1 mb-3 text-white'>2</p>
                            </div>
                        </div>
                    </div>";
                        }
                    }
                    ?>
                        <div class="d-flex mt-2  justify-content-center">
                            <div class="col-6 px-4 py-2" id="group-chats">
                                <img src="./images/icons8-user-group-30.png" id="group-pic" class="ml-4" alt="">
                            </div>
                            <div class=" col-6 px-4 py-2" id="person-chats">
                                <img src="./images/icons8-person-30-red.png" id="person-pic" class="ml-4" alt="">
                            </div>
                        </div>
                </div>
                <div class="person-chat">
                    <div class="d-flex mt-2">
                        <div class="col-9">
                            <p class="mt-1">her/his name</p>
                        </div>
                        <div class="w-25" style="left: 0;">
                            <a href="profile.html"><img src="./images/face1.jpg" class="w-100"></a>
                            <div class="bg-danger " style="position: absolute;margin-top:-50;border-radius: 50%;width:15px;height: 15px;">
                                <p style="font-size: 12px;" class="ml-1 mb-3 text-white">2</p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex mt-2">
                        <div class="col-9">
                            <p class="mt-1">her/his name</p>
                        </div>
                        <div class="w-25" style="left: 0;">
                            <a href="profile.html"><img src="./images/face1.jpg" class="w-100"></a>
                            <div class="bg-danger " style="position: absolute;margin-top:-50;border-radius: 50%;width:15px;height: 15px;">
                                <p style="font-size: 12px;" class="ml-1 mb-3 text-white">2</p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex mt-2">
                        <div class="col-9">
                            <p class="mt-1">her/his name</p>
                        </div>
                        <div class="w-25" style="left: 0;">

                            <a href="profile.html"><img src="./images/face1.jpg" class="w-100"></a>
                            <div class="bg-danger " style="position: absolute;margin-top:-50;border-radius: 50%;width:15px;height: 15px;">
                                <p style="font-size: 12px;" class="ml-1 mb-3 text-white">2</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="group-chat" style="display: none;">
                    <div class="d-flex mt-2">
                        <div class="col-9">
                            <p class="mt-1">Group</p>
                        </div>
                        <div class="w-25" style="left: 0;">
                            <img src="./images/group1.jpg" class="w-100">
                        </div>
                    </div>
                    <div class="d-flex mt-2">
                        <div class="col-9">
                            <p class="mt-1">Group</p>
                        </div>
                        <div class="w-25" style="left: 0;">
                            <img src="./images/group1.jpg" class="w-100">
                        </div>
                    </div>
                    <div class="d-flex mt-2">
                        <div class="col-9">
                            <p class="mt-1">Group</p>
                        </div>
                        <div class="w-25" style="left: 0;">
                            <img src="./images/group1.jpg" class="w-100">
                        </div>
                    </div>

                </div>
                <div class="bg-dark-25 w-100 my-2" style="height: 1px;"></div>
            </div>

            <div class="w-100 mt-2">
                <div>
                    <a href=""><img src="./images/icons8-replay-30.png" class="offset-3 mt-1 d-inline" style="width: 20px ; height: 20px;"></a>
                    <p class="d-inline titer">What's happening</p>


                </div>
                <div class="d-flex mt-5">

                    <p style="font-size: 14px;">Mohammad <br> commented on Zahra <br> ashrafi posted 2 days ago</p>
                    <p class="mt-4 mr-3"><img src="./images/megaphone.png" class="profile-header"></p>
                    <hr>
                </div>
                <div class="d-flex">

                    <p style="font-size: 14px;">Mohammad <br> commented on Zahra <br> ashrafi posted 2 days ago</p>
                    <p class="mt-4 mr-3"><img src="./images/megaphone.png" class="profile-header"></p>
                    <hr>
                </div>
                <div class="d-flex">

                    <p style="font-size: 14px;">Mohammad <br> commented on Zahra <br> ashrafi posted 2 days ago</p>
                    <p class="mt-4 mr-3"><img src="./images/megaphone.png" class="profile-header"></p>
                    <hr>
                </div>
            </div>
        </div>