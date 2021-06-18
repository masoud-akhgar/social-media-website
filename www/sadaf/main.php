<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapczdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" type="" href="./css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
    <script src="../jquery/jquery-3.4.1.min.js.txt"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="httsps://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.search-box input[type="text"]').on("keyup input", function() {
                /* Get input value on change */
                var inputVal = $(this).val();
                var resultDropdown = $(this).siblings(".result");
                if (inputVal.length) {
                    $.get("backend-search.php", {
                        term: inputVal
                    }).done(function(data) {
                        // Display the returned data in browser
                        resultDropdown.html(data);
                    });
                } else {
                    resultDropdown.empty();
                }
            });

            // Set search input value on click of result item
            $(document).on("click", ".result p", function() {
                $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
                $(this).parent(".result").empty();
            });
        });
    </script>
</head>

<body style="background-color: azure;">
    <?php include("header.php");?>
    
    <div class=" d-flex" style="direction:rtl;">
        <?php include("right_side.php");?>

        <div class="col-3 " style="margin-right:17.6667777%;direction: ltr;">
            <div class="bg-white p-1 pl-2 shadow-left stories">
                <p class="titer">Stories</p>
                <div class="d-flex w-100 pb-2">
                    <img class="story" src="./images/story.png">
                    <img class="profile-header ml-1" id="plus" src="./images/plus.png" alt="">
                    <!-- <i class="fa fa-plus" id="plus" style="cursor:pointer;font-size:24px"></i> -->
                    <!-- <img id="plus" src="./images/plus.png"> -->
                    <img class="story" src="./images/story.png">
                    <img class="story" src="./images/story2.png">
                    <img class="story" src="./images/story.png">
                </div>
            </div>
            <div class="bg-white p-1 px-3 shadow-left trending mt-3">
                <p class="titer">Trending !</p>
                <p class="text-info">#sample <br></p>
                <p class="ml-4">post 2<br></p>
                <p class="text-info"> #sample<br></p>
                <p class="ml-4">post 2<br></p>
                <p class="text-info">#sample<br></p>
                <p class="ml-4">post 2<br></p>
                <p class="text-info">#sample<br></p>
                <p class="ml-4">post 2<br></p>
                <p class="text-info">#sample<br></p>
                <p class="ml-4">post 2<br></p>
            </div>
            <div class="bg-white p-1 px-3 shadow-left pb-4 mt-3">
                <div class="d-flex">
                    <p class="titer">People you may know</p>
                    <a href="" class="offset-6"><img src="./images/icons8-replay-30.png" class=" mt-1" style="width: 20px ; height: 20px;"></a>
                </div>

                <div class="d-flex mt-2">
                    <div class="w-25" style="left: 0;">
                        <a href="profile.html"><img src="./images/woman.jpg" class="w-100" style="height:80px;border-radius: 50%;"></a>
                    </div>
                    <div class="col-9">
                        <p class="titer mt-1" style="font-size:20px;">Michaiil Schulist</p>
                        <button class="btn btn-primary py-1 shadow-bottom">Follow</button>
                    </div>
                </div>
                <div class="bg-dark-25 w-100 my-2" style="height: 1px;"></div>
                <div class="d-flex mt-2">
                    <div class="w-25" style="left: 0;">
                        <a href="profile.html"><img src="./images/woman.jpg" class="w-100" style="height:80px;border-radius: 50%;"></a>
                    </div>
                    <div class="col-9">
                        <p class="titer mt-1" style="font-size:20px;">Michaiil Schulist</p>
                        <button class="btn btn-primary py-1 shadow-bottom">Follow</button>
                    </div>
                </div>
                <div class="bg-dark-25 w-100 my-2" style="height: 1px;"></div>
                <div class="d-flex mt-2">
                    <div class="w-25" style="left: 0;">
                        <a href="profile.html"><img src="./images/woman.jpg" class="w-100" style="height:80px;border-radius: 50%;"></a>
                    </div>
                    <div class="col-9">
                        <p class="titer mt-1" style="font-size:20px;">Michaiil Schulist</p>
                        <button class="btn btn-primary py-1 shadow-bottom">Follow</button>
                    </div>
                </div>
                <div class="bg-dark-25 w-100 my-2" style="height: 1px;"></div>
                <div class="d-flex mt-2">
                    <div class="w-25" style="left: 0;">
                        <a href="profile.html"><img src="./images/woman.jpg" class="w-100" style="height:80px;border-radius: 50%;"></a>
                    </div>
                    <div class="col-9">
                        <p class="titer mt-1" style="font-size:20px;">Michaiil Schulist</p>
                        <button class="btn btn-primary py-1 shadow-bottom">Follow</button>
                    </div>
                </div>
                <div class="bg-dark-25 w-100 my-2" style="height: 1px;"></div>
                <div class="bg-dark-25 w-100 my-2" style="height: 1px;"></div>
                <div class="d-flex mt-2">
                    <div class="w-25" style="left: 0;">
                        <a href="profile.html"><img src="./images/woman.jpg" class="w-100" style="height:80px;border-radius: 50%;"></a>
                    </div>
                    <div class="col-9">
                        <p class="titer mt-1" style="font-size:20px;">Michaiil Schulist</p>
                        <button class="btn btn-primary py-1 shadow-bottom">Follow</button>
                    </div>
                </div>
            </div>
            <div class="bg-white p-1 px-3 shadow-left  mt-3">
                <p class="titer">Invite your Friends</p>
                <div class=" border border-1 border-black w-100" style="min-height:40px;">
                    <input placeholder="E-Mali" class="w-100 Mali pl-1" style="min-height:40px;">
                    <a href="" class="btn-primary send pt-1"><i class="fa fa-send text-white mt-1" style="font-size: 20px;"></i></a>
                </div>
                <!-- <img src="./images/send.png" style="height: 100%;"> -->
            </div>

            <div class="bg-white p-1 px-3 shadow-left  mt-3">
                <p class="titer">Pages you may like</p>
                <div class="w-100 border border-1 " style="height: 100%;">
                    <div class="d-flex mt-2 p-2">
                        <div class="w-25" style="left: 0;">
                            <img src="./images/apple.jpg" class="w-100" style="height:80px;border-radius: 50%;">
                        </div>
                        <div class="col-9">
                            <p class="titer mt-2" style="font-size:20px;margin-bottom: 0;"><a href="">silverdnt</a></p>
                            <p>Movies & Animation</p>
                        </div>
                    </div>
                    <img src="./images/Computer.jpg" class="img-fluid mt-2" alt="">
                </div>
            </div>
            <div class="bg-white p-1 pl-2 mt-4 shadow-left">
                <div class="d-flex">
                    <p class="titer d-inline">Suggested groups</p>
                    <a href="" class="offset-6"><img src="./images/icons8-replay-30.png" class=" mt-1" style="width: 20px ; height: 20px;"></a>
                </div>
                <div class="d-flex pages pb-4">
                    <div class="px-1 col-8">
                        <div class="w-100 border border-1 " style="height: 100%;">
                            <div class="d-flex mt-2 px-3">
                                <p class="titer">متخصصان</p>
                                <button class="btn btn-primary px-3 offset-5">join</button>
                            </div>
                            <img src="./images/Computer.jpg" class="img-fluid mt-2">
                            <div class="d-flex mt-2">
                                <p class="titer d-inline mt-1">4 members</p>
                            </div>
                        </div>
                    </div>
                    <div class="px-1 col-8">
                        <div class="w-100 border border-1 " style="height: 100%;">
                            <div class="d-flex mt-2 px-3">
                                <p class="titer">متخصصان</p>
                                <button class="btn btn-primary px-3 offset-5">join</button>
                            </div>
                            <img src="./images/Computer.jpg" class="img-fluid mt-2">
                            <div class="d-flex mt-2">
                                <p class="titer d-inline mt-1">4 members</p>
                            </div>
                        </div>
                    </div>
                </div><br>

            </div>
            <div>
                <div class="d-flex mt-3">
                    <p class="titer"> © 2019 TouchOut</p>
                    <p class="titer offset-5 mt-1"><a href="">language</a></p>
                </div>
                <div class="d-flex titer" style="font-weight: normal;">
                    <p class="ml-2"><a href="">About</a></p>
                    <p class="ml-2"><a href="">blog</a></p>
                    <p class="ml-2"><a href="">Contact Us</a></p>
                    <p class="ml-2"><a href="">Developers</a></p>
                    <p class="ml-2 "><a href="">More
     </a></p>
                </div>
            </div>
        </div>

        <div class="col-5" style="direction: ltr;">
            <div class="bg-white p-2 pl-3 py-1 shadow-left profile welcome2">
                <div class="d-flex"><img src="./images/profile.png">
                    <p class="mt-2 ml-1" style="font-weight: bold"> masoudakhgar</p>
                </div>
                <div class="p-3">
                    <p style="opacity: 0.4;" class="text-dark">what's going on?#Hashtags .. @Mentions.. Links</p>
                </div>
                <div class="bg-dark-25 w-100" style="height:1px;"></div>
                <div class="d-flex mt-2">
                    <div class="bg-dark-25 d-flex option ml-3 px-2">
                        <i class="fa fa-camera mt-2" style="font-size:24px"></i>
                        <p class="titer">upload image</p>
                    </div>
                    <div class="bg-dark-25 d-flex option ml-3 px-2">
                        <i class="fas fa-poll mt-2" style="font-size:24px"></i>
                        <p class="titer">create poll</p>
                    </div>
                    <div class="bg-dark-25 d-flex option ml-3 px-2  ">
                        <i class="fa fa-video-camera mt-2" style="font-size:24px"></i>
                        <p class="titer">upload video</p>
                    </div>
                    <div class="bg-dark-25 d-flex option ml-3 px-2">
                        <i class="fa fa-plus mt-2" style="cursor:pointer;font-size:24px"></i>
                        <!-- <img class=" mt-1" src="./images/plus.png" style="cursor:pointer;font-size:24px"> -->
                        <p class="titer"> more</p>
                    </div>
                </div>
            </div>
            <div class="mt-2 bg-white p-2 pl-3 py-1 shadow-bottom welcome">
                <div class="d-flex">
                    <div class="d-inline col-9">
                        <p style="font-weight: bold">Good morning Masoud Akhger</p>
                        <p>Every new day is chance to change your life</p>
                        <p class="text-primary">#Sample-Company</p>
                    </div>
                    <img class=" mt-1  mt-4 ml-5 " style="width: 70px ; height: 50px;" src="./images/icons8-sunrise-64.png">
                </div>
            </div>
            <div class="mt-3 bg-white  pl-3 shadow-bottom list">
                <p style="font-weight: bold;opacity:0.7">Filter:</p>
                <ul class=" d-flex">
                    <li>
                        <i class="fas fa-film" style="font-size:40px;"></i>
                    </li>
                    <li>
                        <i class="fas fa-scroll" style="font-size:40px"></i>
                    </li>
                    <li>
                        <i class="fas fa-music" style="font-size:40px"></i>
                    </li>

                    <li>
                        <i class="fas fa-map-marker " style="font-size:40px"></i>
                    </li>

                </ul>
            </div>
            <div class="mt-3 bg-white  px-2 py-2 shadow-bottom post pl-4">
                <div class="d-flex">
                <a href="profile.php"><img id="profile-post" class="shadow-bottom" src="./images/profile.png"></a>
                    <div class="ml-2">
                        <a href="profile.php"><p class="mt-1" style="font-weight: bold">masoudakhgar</p></a>
                        <p class="text-dark" style="font-size:12px;margin-top: -20px;">Person - Online 16 hour ago</p>
                    </div>

                </div>
                <a href="https://www.instagram.com/masoudmdar">https://www.instagram.com/masoudmdar</a>
                <br>
                <div class="w-100" style="height: 500px;overflow: hidden;">
                    <a href="post.php"><img src="./images/post.png" class="img-fluid"></a>
                </div>
                <p class="d-inline" style="font-size: 14px;">like 3 comment 1</p>
                <div class="w-100">
                    <div class=" kadr w-100 d-flex post-detail">
                        <p class="text-right detail like">
                            <a href=""><i class="fa fa-thumbs-up"></i> LIKE</a>
                        </p>
                        <p class="text-right detail">
                            <a href=""><i class="fa fa-comments"></i> COMMENT</a>
                        </p>
                        <p class="text-right detail">
                            <a href=""><i class="fa fa-share"></i> SHARE</a>
                        </p>
                    </div>
                </div>

            </div>
            <div class="bg-gray comment p-3 shadow-bottom shadow-left">
                <div class="d-flex">
                    <img src="./images/profile.png">
                    <input type="text " class="comment-holder ml-3 mr-1 col-10" placeholder="Write a Comment and press enter">
                    <i class="fa fa-send mt-2" style="cursor:pointer;font-size:20px"></i>
                    <!-- <img class="ml-2" src="./images/plus.png"> -->
                </div>
            </div>

        </div>

        <?php include("left_side.php")?>
    </div>
    
</body>


</html>