

<header class="headFix">
    <div class="flex maxWid mbPad">
        <div class="flex2"> 
            <div id="header_img">
                <a href="/user/<?php echo $userInfo['dir'] ?>/">   
                    <h1>
                        <img src="/common/img/logo.png" class="retina" alt="talktive"/>
                    </h1>
                </a>
            </div>
        </div>

        <div class="flex2 flexRight">
    <div class="navi"> 
            <div id="nav_toggle">
                <div>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div class="userInfo">
    <div class="wrap">
     <img src="/common/img/icon/icon-human.svg" alt="user"/>
     <span>
        <?php echo $userInfo['name']; ?>様
         
     </span>
    </div>
</div>


            <nav>
                <ul class="navFlex">
	<li><a href="/user/<?php echo $userInfo['dir'] ?>/?page_id=timeline">トーク履歴</a></li>

    <li><a href="/user/<?php echo $userInfo['dir'] ?>/?page_id=mentionstimeline">メッセージ履歴</a></li>
        <li><a href="/user/<?php echo $userInfo['dir'] ?>/?page_id=postcount">投稿数</a></li>
        <li><a href="/user/<?php echo $userInfo['dir'] ?>/?page_id=approval">承認依頼</a></li>
        <li><a href="/user/<?php echo $userInfo['dir'] ?>/?page_id=dmlist">1on1</a></li>
    <li class="btnWrap"><div class="btn"><a href="/user/<?php echo $userInfo['dir'] ?>/?page_id=tweetpost">投稿する</a></div></li>
                </ul>
            </nav>
    </div>
        </div>
    </div>

</header>







