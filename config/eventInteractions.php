   <?php

      if($is_reserved){ ?>
         <img  class = "ticket-icon" src = '/media/icons8-ticket.png' onclick = <?php echo "reservationChecker(this,".$event_id. ",". $_SESSION['user']['user_id']. ")";?>>
      <?php } else {
            if ($event_item['num_tickets'] != $event_item['reserved_tickets'])
            {?>
        <img  class = "ticket-icon" src = '/media/icons8-ticket-blank.png' onclick = <?php echo "reservationChecker(this,".$event_id. ",". $_SESSION['user']['user_id'].")";?> >
      <?php }
      else {?>
         <img class = "ticket-icon" src = '/media/icons8-x-50.png'/>
      <?php }}?>

    <?php if($is_favorite){ ?>
        <img  class = "favorite-icon" src = '/media/icons8-heart-filled.png' onclick = <?php echo "favoriteChecker(this,".$event_id. ",". $_SESSION['user']['user_id'].")";?>>
        <?php } else {?>
        <img  class = "favorite-icon" src = '/media/icons8-heart-blank.png' onclick = <?php echo "favoriteChecker(this,".$event_id. ",". $_SESSION['user']['user_id'].")";?>>
        <?php } ?>