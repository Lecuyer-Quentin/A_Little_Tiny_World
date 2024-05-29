<?php

class Card{
    private $data;
    public function __construct($data){
        $this->set_data($data);        
    }
    private function set_data($data){
        foreach($data as $key => $value){
            $this->data[$key] = $value;
        }
    }
    
    private function get_data(){
        return $this->data;
    }
    private function get_data_of($key){
        return $this->data[$key];
    }

    public function card_dash(){
        $title = $this->get_data_of('title');
        $description = $this->get_data_of('description');
        $value = $this->get_data_of('value');
        $footer = $this->get_data_of('footer');

            $card = "<div class='card m-3 shadow p-10' style='width: 18rem;'>";
                $card .= "<div class='card-header bg-dark bg-gradient text-light d-flex flex-column justify-content-end position-relative'>";
                    $card .= "<h3>".$title."</h3>";
                    $card .= "<p>".$description."</p>";
                    $card .= "<button type='button' data-bs-toggle='collapse' data-bs-target='#test.".$title."' aria-expanded='false' aria-controls='collapseExample ' class='position-absolute top-0 end-0 btn'>";
                        $card .= "<img src='assets/svg/arrow_square_down.svg' alt='arrow' width='20' height='20'>";
                    $card .= "</button>";
                $card .= "</div>";

                $card .= "<div class='card-body d-flex flex-column justify-content-center'>";
                    $card .= "<a href='index.php?page=admin&section=".$value."' class='btn btn-primary w-100 mb-2'>";
                        $card .= "<span>Voir les ".ucfirst($title)."</span>";
                    $card .= "</a>";
                $card .= "</div>";

                $card .= "<div class='collapse' id='test.".$title."'>";
                    $card .= "<div class='card card-footer'>";
                        if(!empty($footer)){
                            foreach($footer as $f){
                                $card .= "<a href='index.php?page=admin&section=".$f['value']."' class='btn btn-primary w-100 mb-2'>";
                                    $card .= "<span>Gestions des ".ucfirst($f['title'])."</span>";
                                $card .= "</a>";
                            }
                        } else {
                            $card .= "<p class='text-center'>Pas de gestion disponible</p>";
                        }
                    $card .= "</div>";
                $card .= "</div>";
            $card .= "</div>";
        return $card;
    }

    public function card_in_cart(){
        $id = $this->get_data_of('id');
        $prix = $this->get_data_of('prix');
        $quantity = $this->get_data_of('quantity');
        $total = $prix * $quantity;
        $nom = $this->get_data_of('nom');
        $image = $this->get_data_of('image');

        $card = '<div class="card text-white bg-dark shadow w-100 d-flex justify-content-between align-items-center m-2 position-relative" style=" height:14rem; width: 22rem;">';

            $card .= '<div class="card-header w-100 d-flex justify-content-between align-items-center">';
                $card .= '<p class="card-title">' . $nom . '</p>';
                $card .= '<div class ="d-flex justify-content-around">';
                    $card .= '<form action="controllers/cart/add.php" method="post">';
                        $card .= '<input type="hidden" name="id" value="' . $id . '">';
                        $card .= '<input type="hidden" name="quantity" value="1">';
                        $card .= '<button type="submit" class="btn btn-success mx-1">';
                            $card .= '<img src="assets/svg/add_cart.svg" alt="add to cart" width="20" height="20">';
                        $card .= '</button>';
                    $card .= '</form>';
                    $card .= '<form action="controllers/cart/remove.php" method="post">';
                        $card .= '<input type="hidden" name="id" value="' . $id . '">';
                        $card .= '<input type="hidden" name="quantity" value="1">';
                        $card .= '<button type="submit" class="btn btn-danger">';
                            $card .= '<img src="assets/svg/remove_cart.svg" alt="remove from cart" width="20" height="20">';
                        $card .= '</button>';
                    $card .= '</form>';
                $card .= '</div>';
            $card .= '</div>';

            $card .= '<img  style=" height: 7rem; width: 20rem;" src="' . $image . '" class="card-img" alt="' . $nom . '">';

            $card .= '<div class="card-img-overlay w-100 h-50 mt-5">'; 
            $card .= '<div class="card-body">';
            $card .= '<table class="table table-dark table-striped table-bordered table-hover table-sm w-50 text-center ">';
            $card .= '<thead>';
                $card .= '<tr>';
                    $card .= '<th scope="col">Prix</th>';
                    $card .= '<th scope="col">Quantité</th>';
                $card .= '</tr>';
            $card .= '</thead>';
            $card .= '<tbody>';
                $card .= '<tr>';
                    $card .= '<td>' . $prix . ' €</td>';
                    $card .= '<td>' . $quantity . '</td>';
                $card .= '</tr>';
            $card .= '</tbody>';
            $card .= '</table>';

            $card .= '</div>';
        $card .= '</div>';

            $card .= '<div class="card-footer w-100 d-flex justify-content-between align-items-center">';
                $card.= '<a href="index.php?page=product&id=' . $id . '" class="btn btn-primary">Voir le produit</a>';
                $card .= '<p class="card-text"><strong>Total : ' . $total . ' €</strong></p>';
            $card .=  '</div>';

        $card .= '</div>';
        return $card;
        
    }

    public function card_sm()
    {
        $card = '<div class="card testHover text-white bg-dark text-center p-2 position-relative" style="width: 8rem; height: 10rem;">';
            $card .= '<img src="' . $this->get_data_of('image') .'" class="card-img w-100 h-100" alt="' . $this->get_data_of('nom') . '">';
            $card .= '<div class="card-img-overlay w-100 h-100 d-flex flex-column justify-content-end opacity-50">'; 
                    $card .= '<a href="index.php?page=product&id=' . $this->get_data_of('id') . '" class="btn btn-info text-white d-flex justify-content-around align-items-center">';
                        $card .=  $this->get_data_of('prix') . ' €';
                        $card .= '<img src="assets/svg/arrow_right.svg" alt="voir" width="20" height="20">';
                    $card .= '</a>';
            $card .= '</div>';
        $card .= '</div>';
        return $card;
    }

    public function card_md(){

        $fav_value = (isset($_SESSION['favorite']) && in_array($this->get_data_of('id'), $_SESSION['favorite']))
                    || (isset($_COOKIE['favorite']) && in_array($this->get_data_of('id'), json_decode($_COOKIE['favorite'], true)))
                    ? 'remove' 
                    : 'add';
        $heart_grey = 'assets/svg/heart_bm_grey.svg';
        $heart_red = 'assets/svg/heart_bm_red.svg';
        $fav_trigger = $fav_value == 'add' ? $heart_grey : $heart_red;
        
        $card = '<div class="card text-white bg-dark text-center p-2 position-relative" style="width: 22rem; height: 30rem;">';
            if(!empty($this->get_data_of('special'))){
                $card .= '<div class="position-absolute top-0 start-0 z-index-1">';
                    $card .= '<span class="badge bg-primary my-2 mx-2">' . $this->get_data_of('special') . '</span>';
                $card .= '</div>';
            }

            $card .= '<img src="' . $this->get_data_of('image') . '" class="card-img-top w-100 h-100" alt="' . $this->get_data_of('nom') . '">';
            $card .= '<div class="card-img-overlay w-100 h-100 d-flex flex-column justify-content-end">';

                $card .= '<div class="position-absolute top-0 end-0">';
                $card .= '<form action="controllers/favorite/favorite.php" method="post" id="favorite_form" class="d-flex justify-content-around align-items-center my-2">';
                    $card .= '<input type="hidden" name="id" value="' . $this->get_data_of('id') . '">';
                    $card .= '<input type="hidden" name="favorite" value='.$fav_value.'>';
                    $card .= '<button type="submit" class="btn btn-link">';
                    $card .= '<img src="'.$fav_trigger.'" alt="trigger" width="40" height="40">';
                    $card .= '</button>';
                $card .= '</form>';
                $card .= '</div>';

                $card .= '<div class="card-footer d-flex justify-content-between align-item-center border border-3 border-dark border-start-0 border-end-0 shadow">';
                    $card .= '<p class="card-text text-white my-2 font-weight-bold text-left font-size-5">' . $this->get_data_of('prix') . ' €</p>';

                    $card .= '<div class="d-flex justify-content-around">';

                        $card .= '<form action="controllers/cart/add.php" method="post" id="cart_add_form">';
                            $card .= '<input type="hidden" name="id" value="' . $this->get_data_of('id') . '">';
                            $card .= '<input type="hidden" name="quantity" value="1">';
                            $card .= '<button type="submit" class="btn btn-primary">';
                                $card .= '<img src="assets/svg/add_cart.svg" alt="add to cart" width="20" height="20">';
                            $card .= '</button>';
                        $card .= '</form>';

                        $card .= '<form action="controllers/cart/remove.php" method="post" id="cart_remove_form">';
                            $card .= '<input type="hidden" name="id" value="' . $this->get_data_of('id') . '">';
                            $card .= '<input type="hidden" name="quantity" value="1">';
                            $card .= '<button type="submit" class="btn btn-danger mx-2">';
                                $card .= '<img src="assets/svg/remove_cart.svg" alt="remove from cart" width="20" height="20">';
                            $card .= '</button>';
                        $card .= '</form>';
                    $card .=  '</div>';
                $card .= '</div>';
            $card .= '</div>';
        $card .= '</div>';
        return $card;
    }

    public function card_service(){
        $title = $this->get_data_of('title');
        $description = $this->get_data_of('description');
        $link = $this->get_data_of('link');

        $card = "<div class='card m-3 shadow p-10' style='width: 18rem;'>";
            $card .= "<div class='card-header bg-dark bg-gradient text-light d-flex flex-column justify-content-end position-relative'>";
                $card .= "<h5>".$title."</h5>";
                $card .= "<p>".$description."</p>";
            $card .= "</div>";

            $card .= "<div class='card-body d-flex flex-column justify-content-center'>";
                $card .= "<a href=".$this->get_data_of('link')." class='btn btn-primary w-100 mb-2'>";
                    $card .= "<span>Voir les ".ucfirst($title)."</span>";
                $card .= "</a>";
                $card .= "</div>";

        $card .= "</div>";
        return $card;
    }
}
