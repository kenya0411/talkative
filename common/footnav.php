
<section class="footerNav">
	<div class="wrapper pcInvi">
		
		<ul class="mbPad">
	<li class="num1 now_<?php if($page_id==""){echo 'timeline';} ?>"><a href="/user/<?php echo $userInfo['dir'] ?>/">
	  <svg>
    <use xlink:href="/common/img/icon/icon-home.svg#icon_home"></use>
  </svg>
	</a></li>
	<li class="num2 now_<?php if($page_id=="mentionstimeline"){echo 'mentionstimeline';} ?>"><a href="/user/<?php echo $userInfo['dir'] ?>/?page_id=mentionstimeline">
	  <svg>
    <use xlink:href="/common/img/icon/icon-talk.svg#icon_talk"></use>
  </svg>
	</a></li>

		<li class="num3 now_<?php if($page_id=="dmlist"||$page_id=="dmshow"){echo 'dmpage';} ?>"><a href="/user/<?php echo $userInfo['dir'] ?>/?page_id=dmlist">
  <svg>
    <use xlink:href="/common/img/icon/icon-dm.svg#icon_dm"></use>
  </svg>
	</a></li>

	<li class="num4 now_<?php if($page_id=="tweetpost"||$page_id=="response"){echo 'tweetpost';} ?>"><a href="/user/<?php echo $userInfo['dir'] ?>/?page_id=tweetpost">
  <svg>
    <use xlink:href="/common/img/icon/icon-edit.svg#icon_edit"></use>
  </svg>
	</a></li>

		</ul>
	</div>

</section>