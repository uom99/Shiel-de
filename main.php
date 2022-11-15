<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<head>

    <?php include_once "./head.html" ?>

</head>

<body>
    <header>
        <?php include_once "header.php" ?>
    </header>
    <main id="fullpage">
        <div class="section bg-dark">
            <video style="width:100%; height:100%; object-fit:fill;" autoplay muted src="./imgs/메인.mp4"></video>
        </div>

        <div class="section bg-opacity-50" style="background-color:#aca193">
            <div class="container">
                <div id="indicators" class="carousel carousel-dark slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#indicators" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#indicators" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#indicators" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                        <button type="button" data-bs-target="#indicators" data-bs-slide-to="3"
                            aria-label="Slide 4"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="2000">
                            <img src="./imgs/Slide_1.png" class="d-block w-100 h-100 img-thumbnail" alt="...">
                        </div>
                        <div class="carousel-item" data-bs-interval="2000">
                            <img src="./imgs/Slide_2.png" class="d-block w-100 h-100 img-thumbnail" alt="...">
                        </div>
                        <div class="carousel-item" data-bs-interval="2000">
                            <img src="./imgs/Slide_3.png" class="d-block w-100 h-100 img-thumbnail" alt="...">
                        </div>
                        <div class="carousel-item" data-bs-interval="2000">
                            <img src="./imgs/Slide_4.png" class="d-block w-100 h-100 img-thumbnail" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#indicators"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#indicators"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>



        <div class="section" style="background-color:#aca193">
            <div class="container my-3 p-3 bg-body rounded shadow-sm">
                <h4 class="border-bottom pb-2 mb-0">명예의전당</h4>
                <div class="d-flex border-bottom">
                    <div class="d-flex text-muted pt-3 w-100 mx-auto">
                        <div class="pb-3 mb-0 small lh-sm w-100 h-100">
                            <div class="d-flex justify-content-between">
                                <div class="btn-group w-100" role="group" aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check bestwriting" value="week_best_likes"
                                        name="bestw" id="week_best_likes" autocomplete="off" checked>
                                    <label class="btn btn-outline-dark" for="week_best_likes">이번주 베스트(좋아요)</label>

                                    <input type="radio" class="btn-check bestwriting" value="week_best_hit" name="bestw"
                                        id="week_best_hit" autocomplete="off">
                                    <label class="btn btn-outline-dark" for="week_best_hit">이번주 베스트(조회수)</label>

                                    <input type="radio" class="btn-check bestwriting" value="month_best_likes"
                                        name="bestw" id="month_best_likes" autocomplete="off">
                                    <label class="btn btn-outline-dark" for="month_best_likes">이달의 베스트(좋아요)</label>

                                    <input type="radio" class="btn-check bestwriting" value="month_best_hit"
                                        name="bestw" id="month_best_hit" autocomplete="off">
                                    <label class="btn btn-outline-dark" for="month_best_hit">이달의 베스트(조회수)</label>
                                </div>

                            </div>
                            <div class="week_best_like">
                                <table class="table table-hover mt-1" style="border: 1px solid #ddddda">
                                    <tr>
                                        <th style="background-color: #fff1e0; text-align: center;">번호</th>
                                        <th style="background-color: #fff1e0;">카테고리</th>
                                        <th style="background-color: #fff1e0;">제목</th>
                                        <th style="background-color: #fff1e0; text-align: center;">닉네임</th>
                                        <th style="background-color: #fff1e0; text-align: center;">작성일</th>
                                        <th style="background-color: #fff1e0; text-align: center;">조회수</th>
                                        <th style="background-color: #fff1e0; text-align: center;">추천</th>
                                    </tr>
                                    <?php
                    $sql = "SELECT * from board WHERE date between date_add(now(), interval -1 week) and now() order by like_count desc limit 15;";
                    $result = mysqli_query($conn,$sql);
                    $total_record =  mysqli_num_rows($result); // 게시?�� �? ?��코드 ?��z
                    while($board = mysqli_fetch_array($result)){
                    $title = $board["title"];
                    if(strlen($title)>30){
                      $title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]);
                    }
                                      
                    $sql5 = "select * from reply where idx='".$board['idx']."'";
                    $result5 = mysqli_query($conn,$sql5);
                    $rep_count = mysqli_num_rows($result5);
                  ?>
                                    <tr class="read_check" style="cursor:pointer"
                                        data-action="read.php?idx=<?=$board['idx']?>">
                                        <td style="text-align : center" width="70"><?=$board['idx'];?></td>
                                        <td width="150"><?=$board['category']?></td>
                                        <td width="300"><?=$title?><span class="text-danger" style="font-size:14px">
                                                [<?= $rep_count?>]</span>
                                        </td>
                                        <td style="text-align : center" width="200">
                                            <?=$board['nick'];?><?=$board['c_nick']?></td>
                                        <td style="text-align : center" width="200"><?=$board['date'];?></td>
                                        <td style="text-align : center" width="110"><?=$board['hit']; ?></td>
                                        <td style="text-align : center" width="110"><?=$board['like_count']?></td>
                                    </tr>
                                    <?php
              }
              ?>
                                </table>
                            </div>
                            <div class="month_best_like" style="display:none">
                                <table class="table table-hover mt-1" style="border: 1px solid #ddddda">
                                    <tr>
                                        <th style="background-color: #fff1e0; text-align: center;">번호</th>
                                        <th style="background-color: #fff1e0;">카테고리</th>
                                        <th style="background-color: #fff1e0;">제목</th>
                                        <th style="background-color: #fff1e0; text-align: center;">닉네임</th>
                                        <th style="background-color: #fff1e0; text-align: center;">작성일</th>
                                        <th style="background-color: #fff1e0; text-align: center;">조회수</th>
                                        <th style="background-color: #fff1e0; text-align: center;">추천</th>
                                    </tr>
                                    <?php
                    $sql = "SELECT * from board WHERE date between date_add(now(), interval -1 month) and now() order by like_count desc limit 15;";
                    $result = mysqli_query($conn,$sql);
                    $total_record =  mysqli_num_rows($result); // 게시?�� �? ?��코드 ?��z
                    while($board = mysqli_fetch_array($result)){
                    $title = $board["title"];
                    if(strlen($title)>30){
                      $title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]);
                    }
                                      
                    $sql5 = "select * from reply where idx='".$board['idx']."'";
                    $result5 = mysqli_query($conn,$sql5);
                    $rep_count = mysqli_num_rows($result5);
                  ?>
                                    <tr class="read_check" style="cursor:pointer"
                                        data-action="read.php?idx=<?=$board['idx']?>">
                                        <td style="text-align : center" width="70"><?=$board['idx'];?></td>
                                        <td width="150"><?=$board['category']?></td>
                                        <td width="300"><?=$title?><span class="text-danger" style="font-size:14px">
                                                [<?= $rep_count?>]</span>
                                        </td>
                                        <td style="text-align : center" width="200">
                                            <?=$board['nick'];?><?=$board['c_nick']?></td>
                                        <td style="text-align : center" width="200"><?=$board['date'];?></td>
                                        <td style="text-align : center" width="110"><?=$board['hit']; ?></td>
                                        <td style="text-align : center" width="110"><?=$board['like_count']?></td>
                                    </tr>
                                    <?php
              }
              ?>
                                </table>
                            </div>
                            <div class="week_best_hit" style="display:none">
                                <table class="table table-hover mt-1" style="border: 1px solid #ddddda">
                                <tr>
                                        <th style="background-color: #fff1e0; text-align: center;">번호</th>
                                        <th style="background-color: #fff1e0;">카테고리</th>
                                        <th style="background-color: #fff1e0;">제목</th>
                                        <th style="background-color: #fff1e0; text-align: center;">닉네임</th>
                                        <th style="background-color: #fff1e0; text-align: center;">작성일</th>
                                        <th style="background-color: #fff1e0; text-align: center;">조회수</th>
                                        <th style="background-color: #fff1e0; text-align: center;">추천</th>
                                    </tr>
                                    <?php
                    $sql = "SELECT * from board WHERE date between date_add(now(), interval -1 week) and now() order by hit desc limit 15;";
                    $result = mysqli_query($conn,$sql);
                    $total_record =  mysqli_num_rows($result); // 게시?�� �? ?��코드 ?��z
                    while($board = mysqli_fetch_array($result)){
                    $title = $board["title"];
                    if(strlen($title)>30){
                      $title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]);
                    }
                                      
                    $sql5 = "select * from reply where idx='".$board['idx']."'";
                    $result5 = mysqli_query($conn,$sql5);
                    $rep_count = mysqli_num_rows($result5);
                  ?>
                                    <tr class="read_check" style="cursor:pointer"
                                        data-action="read.php?idx=<?=$board['idx']?>">
                                        <td style="text-align : center" width="70"><?=$board['idx'];?></td>
                                        <td width="150"><?=$board['category']?></td>
                                        <td width="300"><?=$title?><span class="text-danger" style="font-size:14px">
                                                [<?= $rep_count?>]</span>
                                        </td>
                                        <td style="text-align : center" width="200">
                                            <?=$board['nick'];?><?=$board['c_nick']?></td>
                                        <td style="text-align : center" width="200"><?=$board['date'];?></td>
                                        <td style="text-align : center" width="110"><?=$board['hit']; ?></td>
                                        <td style="text-align : center" width="110"><?=$board['like_count']?></td>
                                    </tr>
                                    <?php
              }
              ?>
                                </table>
                            </div>
                            <div class="month_best_hit" style="display:none">
                                <table class="table table-hover mt-1" style="border: 1px solid #ddddda">
                                <tr>
                                        <th style="background-color: #fff1e0; text-align: center;">번호</th>
                                        <th style="background-color: #fff1e0;">카테고리</th>
                                        <th style="background-color: #fff1e0;">제목</th>
                                        <th style="background-color: #fff1e0; text-align: center;">닉네임</th>
                                        <th style="background-color: #fff1e0; text-align: center;">작성일</th>
                                        <th style="background-color: #fff1e0; text-align: center;">조회수</th>
                                        <th style="background-color: #fff1e0; text-align: center;">추천</th>
                                    </tr>
                                    <?php
                    $sql = "SELECT * from board WHERE date between date_add(now(), interval -1 month) and now() order by hit desc limit 15;";
                    $result = mysqli_query($conn,$sql);
                    $total_record =  mysqli_num_rows($result); // 게시?�� �? ?��코드 ?��z
                    while($board = mysqli_fetch_array($result)){
                    $title = $board["title"];
                    if(strlen($title)>30){
                      $title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]);
                    }
                                      
                    $sql5 = "select * from reply where idx='".$board['idx']."'";
                    $result5 = mysqli_query($conn,$sql5);
                    $rep_count = mysqli_num_rows($result5);
                  ?>
                                    <tr class="read_check" style="cursor:pointer"
                                        data-action="read.php?idx=<?=$board['idx']?>">
                                        <td style="text-align : center" width="70"><?=$board['idx'];?></td>
                                        <td width="150"><?=$board['category']?></td>
                                        <td width="300"><?=$title?><span class="text-danger" style="font-size:14px">
                                                [<?= $rep_count?>]</span>
                                        </td>
                                        <td style="text-align : center" width="200">
                                            <?=$board['nick'];?><?=$board['c_nick']?></td>
                                        <td style="text-align : center" width="200"><?=$board['date'];?></td>
                                        <td style="text-align : center" width="110"><?=$board['hit']; ?></td>
                                        <td style="text-align : center" width="110"><?=$board['like_count']?></td>
                                    </tr>
                                    <?php
              }
              ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="section fp-auto-height">
            <?php include_once "footer.html" ?>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script>
    <!-- 일반 글 클릭시 해당 idx의 read 페이지로 이동하는 이벤트 
    -->
    $(function()
    {
    $(".read_check").click(function()
    {
    var
    action_url
    =
    $(this).attr("data-action");
    console.log(action_url);
    $(location).attr("href",
    action_url);
    });
    });
    </script>
</body>

</html>