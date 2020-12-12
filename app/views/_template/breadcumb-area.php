<?php 
	if ($this->_controller == 'index' && $this->_action == 'rooms') :
		$h2 = 'Rooms';
		$background = 'bg-6.jpg';
	elseif ($this->_controller == 'index' && $this->_action == 'aboutus') : 
		$h2 = 'About us';
		$background = 'bg-2.jpg';
	elseif ($this->_controller == 'index' && $this->_action == 'termsconditions') : 
		$h2 = 'Terms & Conditions';
		$background = 'bg-4.jpg';
	elseif ($this->_controller == 'index' && ($this->_action == 'news' || $this->_action == 'post')) :
        $h2 = 'News & Events';
	    $background = 'bg-7.jpg';
    elseif ($this->_controller == 'index' && $this->_action == 'contact') :
        $h2 = 'Contact us';
        $background = 'bg-8.jpg';
    elseif ($this->_controller == 'user' && $this->_action == 'reservations') :
        $h2 = 'My Reservations';
        $background = 'bg-1.jpg';
    elseif ($this->_controller == 'user' && ($this->_action == 'messages' || $this->_action == 'message')) :
        $h2 = 'Conversations';
        $background = 'bg-5.jpg';
    elseif ($this->_controller == 'user' && ($this->_action == 'profile' || $this->_action == 'editprofile')) :
        $h2 = 'My Profile';
        $background = 'bg-9.jpg';
    elseif ($this->_controller == 'reservation' && $this->_action == 'reservation') :
        $h2 = 'Reservation';
        $background = 'bg-10.jpg';
    elseif ($this->_controller == 'reservation' && $this->_action == 'payment') :
        $h2 = 'Reservation & Payment';
        $background = 'bg-4.jpg';
    elseif ($this->_controller == 'reservation' && $this->_action == 'reservationdetails') :
        $h2 = 'Reservation & Invoice';
        $background = 'bg-2.jpg';
	else :
		$h2 = 'Home';
		$background = 'bg-3.jpg';
	endif;

?>

<!-- ##### Breadcumb Area Start ##### -->
<section class="breadcumb-area bg-img d-flex align-items-center justify-content-center" style="background-image: url(<?= IMAGES_DIR . 'bg-img/' . $background ?>);">
    <div class="bradcumbContent">
        <h2><?= $h2 ?></h2>
    </div>
</section>
<!-- ##### Breadcumb Area End ##### -->
