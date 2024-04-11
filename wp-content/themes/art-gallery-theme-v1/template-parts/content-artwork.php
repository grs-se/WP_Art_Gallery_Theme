 <div class="artwork-item">
   <li class="artwork-card__list-item">
     <a class="artwork-card" href="<?php the_permalink(); ?>">
       <div class="artwork-card__image-container">
         <div class="artwork-card__image-wrapper">
           <img class="artwork-card__image" src="<?php the_post_thumbnail_url() ?>">
         </div>
       </div>
       <!-- <img class="professor-card__image" src="<?php the_post_thumbnail(); ?>"> -->

       <div class="artwork-card__info">
         <span class="artwork-card__name"><?php the_title(); ?></span>
       </div>
     </a>
   </li>
 </div>