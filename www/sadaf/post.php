<!DOCTYPE html>
<html>


<head>
<meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" type="" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fonstawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" type="" href="../bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
    <link rel="stylesheet" href="./css/profile.css">
    <link rel="stylesheet" href="./css/login.css">
    <script src="../jquery/jquery-3.4.1.min.js.txt"></script>
    <script src="./js/right_script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
<?php include("header.php"); ?>
    <div class=" d-flex" style="direction:rtl;">
            <?php include("right_side.php"); ?>
    </div>
    <div class="profile2">
        <div class="profile2-content">
            <div class="content-middle">
                <div class="content-md-left">
                    <img src="https://i.pravatar.cc/300?img=7">
                </div>
                <div class="content-md-middle">
                    <div class="post-title-name">
                        <a href="">Daniel Jack</a><br>
                    </div>
                    <div class="post-title-time">
                        <a href="">Saturday 13:52</a>
                    </div>
                    <div class="post-desc">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum molestie eleifend orci non varius. Integer et mauris quis neque blandit sagittis.
                        <br>
                        <img src="./images/Computer.jpg" class="w-100">
                    </div>
                    <div class="mt-3 bg-white w-100 px-2 py-2 shadow-bottom post pl-4">
                        <p class="d-inline" style="font-size: 14px;">like 3 comment 1</p>
                        <div class="w-100">
                            <div class=" kadr w-100 d-flex post-detail">
                                <p class="text-rights detail like">
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
                        <div class="bg-gray comment p-3 shadow-bottom shadow-left w-100">
                            <div class="d-flex w-100">
                                <img src="./images/profile.png">
                                <input type="text " class="comment-holder ml-3 col-10 mr-1" placeholder="Write a Comment and press enter">
                                <i class="fa fa-send mt-2" style="cursor:pointer;font-size:20px"></i>
                                <!-- <img class="ml-2" src="./images/plus.png"> -->
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 w-100  py-2 post ">
                        <hr>
                        <div class="bg-gray comment p-3 ">
                            <div class="d-flex">
                                <img src="./images/profile.png">
                                <p class="text-dark ml-3 mt-4 ">bla bla blaaa... bla bla blaaa... bla bla blaaa...bla bla blaaa...bla bla blaaa...bla bla blaaa...bla bla blaaa...bla bla blaaa...</p>
                                <!-- <input type="text " class="comment-holder ml-3 mr-1 col-11" placeholder="Write a Comment and press enter"> -->
                                <!-- <img class="ml-2" src="./images/plus.png"> -->
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 w-100  py-2 post ">
                        <hr>
                        <div class="bg-gray comment p-3 ">
                            <div class="d-flex">
                                <img src="./images/profile.png">
                                <p class="text-dark ml-3 mt-4 ">bla bla blaaa... bla bla blaaa... bla bla blaaa...bla bla blaaa...bla bla blaaa...bla bla blaaa...bla bla blaaa...bla bla blaaa...</p>
                                <!-- <input type="text " class="comment-holder ml-3 mr-1 col-11" placeholder="Write a Comment and press enter"> -->
                                <!-- <img class="ml-2" src="./images/plus.png"> -->
                            </div>
                        </div>
                    </div><div class="mt-3 w-100  py-2 post ">
                        <hr>
                        <div class="bg-gray comment p-3 ">
                            <div class="d-flex">
                                <img src="./images/profile.png">
                                <p class="text-dark ml-3 mt-4 ">bla bla blaaa... bla bla blaaa... bla bla blaaa...bla bla blaaa...bla bla blaaa...bla bla blaaa...bla bla blaaa...bla bla blaaa...</p>
                                <!-- <input type="text " class="comment-holder ml-3 mr-1 col-11" placeholder="Write a Comment and press enter"> -->
                                <!-- <img class="ml-2" src="./images/plus.png"> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><br><br><br><br>
</body>

</html>