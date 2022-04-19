<body>
    <?php include 'pages/components/html-navbar.php'?>
    <div class="container mt-5 pt-5">
        <p id="news-date" class="fs-6 mb-0" style="color: gray;">Senin, 7 Februari 2022</p>
        <p id="news-author" class="fs-6" style="color: gray;">Author: HitungCuan</p>
        <h1>Crypto Crash Lagi?</h1>
        <div class="news-image mt-3">
            <img src="images/news/cryptocurrency1.jpg" alt="news_image" class="img-fluid">
        </div>
        <p id="news-caption" class="fs-6" style="color: gray;">Ilustrasi: Cryptocurrency</p>
        <div class="news-text">
            <p class="fs-6">Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda repudiandae nam tempora. Doloremque corrupti sed quo itaque ratione aliquid, expedita vitae fuga provident, aut atque recusandae neque aspernatur quaerat doloribus? Lorem ipsum
                dolor sit amet consectetur adipisicing elit. Pariatur magni quod cupiditate ex animi eum sed quaerat delectus minima sunt, amet vel. Nisi cum vitae, perferendis iusto sint maiores dolores, deleniti doloremque, fuga excepturi porro et!
                Possimus autem nobis laborum deserunt, error voluptas libero maxime nihil architecto eveniet nemo? Atque eligendi, repellendus iste cumque sit deserunt saepe unde voluptatibus et laudantium ipsum cupiditate modi. Sapiente fugit corrupti
                in deserunt itaque. Esse neque at nostrum officia corporis eos distinctio pariatur magnam quo illum autem totam suscipit non fugiat consequuntur voluptatem labore necessitatibus fuga commodi, facilis ad ab. Animi enim consequatur impedit!</p>
            <br>
            <p class="fs-6">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci temporibus quam eveniet tempore, cum magnam corporis facere dolor recusandae odit rem sunt, quos earum quae iusto delectus culpa accusantium labore, quia est nisi nostrum. Dolore odit eligendi
                doloribus officia ea rem fugit itaque aliquam, quam magnam obcaecati reprehenderit ad vitae deleniti aut reiciendis soluta officiis quia cupiditate corporis inventore distinctio esse labore? Autem corporis quis quam exercitationem nesciunt.
                Odio, doloremque.
            </p>
            <br>
            <p class="fs-6">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci temporibus quam eveniet tempore, cum magnam corporis facere dolor recusandae odit rem sunt, quos earum quae iusto delectus culpa accusantium labore, quia est nisi nostrum. Dolore odit eligendi
                doloribus officia ea rem fugit itaque aliquam, quam magnam obcaecati reprehenderit ad vitae deleniti aut reiciendis soluta officiis quia cupiditate corporis inventore distinctio esse labore? Autem corporis quis quam exercitationem nesciunt.
                Odio, doloremque.
            </p>
        </div>
    </div>
    <hr>

    <div class="container container-comment">

        <!-- Input komentar -->
        <form action="">
            <div class="row new-comment pt-1 pb-2">
                <div class="col-sm col-md-10 col-lg-10">
                    <input class="form-control montserrat w-100" id="txtComment" placeholder="Write Comment Here"></input>
                </div>
                <div class="col-sm col-md-2 col-lg-2">
                    <button type="submit" id="btnComment" class="w-100 h-100 montserrat btn-sm btn-lg">Comment</button>
                </div>
            </div>
        </form>

        <!-- List komentar -->

        <div class="row posted-comment pt-4 px-2">
            <div class="wrapper-comment">
                <div class="user-img">
                    <img src="images/news/comment/childe.png" alt="user" class="img-fluid" style="border-radius: 100%;">
                </div>
                <div class="px-3 pt-1 pb-1">
                    <p class="comment-author mb-0">Childe</p>
                    <p class="comment-date mb-2">At 01/03/2022</p>
                    <p class="comment-text text-wrap">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi error explicabo laudantium eos qui, reprehenderit asperiores, laboriosam exercitationem corporis, assumenda corrupti quidem quia obcaecati a magnam minus quae quo? Quos?
                    </p>
                </div>
            </div>
        </div>
    </div>
    <?php include 'pages/components/html-top.php'?>
</body>
</html>