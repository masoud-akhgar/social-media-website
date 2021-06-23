<div class=" d-flex" style="direction:rtl;: left">
    <div class="col-2 shadow-left ml-3 pt-2" style="margin-top: 82px; background-color: #f6f6f6;top:-20px;height: 900px;position: fixed;">
        <div class="text-left">

            <!-- <div class="mt-1 d-inline">
                <button type="button" id="dropdownbtn" class="ml-2 bg-none border-none mt-1"><img src="asset/images/down.png" class="" style="height: 10px;width: 15px;" alt=""></button>
            </div>
            <a href="" style=""><img class=" d-inline titer" style="margin-left: 60%;opacity: 0.3;height: 25px;width: 30px;" src="asset/images/groupp.png"></a> -->
            <p class=" d-inline titer">Chat</p>
        </div>
        <div class="d-flex shadow-bottom shadow-left py-3 bg-white" id="online">
            <div class="d-flex">
                <button class="btn hover-primary"> online <img src="asset/images/eye.png" style="width: 20px;"> </button>
            </div>
            <div class="d-flex">
                <button class="btn hover-primary">offline <img src="asset/images/invisible.png" style="width: 20px;"> </button>
            </div>
        </div>
        <div class=" mt-2">
            <div>
                <form class="row" action="" method="GET">
                    <div class="form-group col-auto">
                        <input type="text" name="query" placeholder="search for users" style="width: 200px" />
                        <input type="submit" name="submit" value="Search" />
                    </div>
                </form>
            </div>
            <div class="search">
                <?php

                if(isset($_GET['submit'])){

                    if(!empty($_GET['query'])) {
                        $query = $_GET['query'];
                        $mysql = pdodb::getInstance();
                        $res = $mysql->Execute("select * from sadaf.user where username like '%$query%' ");
                    }


                    while($rec = $res->fetch())
                    {
                        echo "<div class='d-flex mt-2'>
                            <div class='col-9'>
                                <p class='mt-1'>"."@". $rec['username'] ."</p>
                            </div>
        
                           
                        </div>";

                    }
                }
                ?>
            </div>

        </div>

    </div>