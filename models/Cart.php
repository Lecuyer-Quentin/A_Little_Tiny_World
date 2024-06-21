<?php

class Cart {
    private $cart;
    private $total;
    private $count;

    public function __construct() {
        $this->cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        $this->total = 0;
        $this->count = $this->count();
    }

    public function get_value_of($key) {
        return $this->$key;
    }

    public function addToCart($id, $quantity) {
        if (isset($this->cart[$id])) {
            $this->cart[$id]['quantity'] += $quantity;
        } else {
            $this->cart[$id] = ['quantity' => $quantity];
        }
        $_SESSION['cart'] = $this->cart;
        setcookie('cart', json_encode($this->cart), time() + 3600, '/');
    }

    public function removeFromCart($id, $quantity) {
        if (isset($this->cart[$id])) {
            $this->cart[$id]['quantity'] -= $quantity;
            if ($this->cart[$id]['quantity'] <= 0) {
                unset($this->cart[$id]);
            }
        }
        $_SESSION['cart'] = $this->cart;
    }
    
    public function emptyCart() {
        $this->cart = [];
        $this->total = 0;
        $this->count = 0;
        $_SESSION['cart'] = $this->cart;
        //setcookie('cart', json_encode($this->cart, time() + 3600, '/'));
    }

   private function count(){
        $count = 0;
        foreach($this->cart as $id => $product) {
            $count += $product['quantity'];
        }
        return $count;
   }

    public function cart_trigger() {
        $color = $this->count > 0 ? '#32de84' : 'black';
        $trigger = "<button class='nav-link position-relative' type='button' data-bs-toggle='offcanvas' data-bs-target='#offcanvasCart' aria-controls='offcanvasExample'>";
        $trigger .= "<img src='assets/svg/cart.svg' alt='Mon Panier' width='25' height='25'>";
        $trigger .= '<span class="position-absolute top-50 start-50 font-size-6 badge rounded-pill mx-2" style="color:'.$color.'">';
        $trigger .= '('.$this->count.')';
        $trigger .= '<span class="visually-hidden">items in cart</span>';
        $trigger .= '</span>';
        $trigger .= '</button>';
        return $trigger;
    }
    public function off_canvas() {
        $off_canvas = "<article class='offcanvas offcanvas-end min-vh-100'
        data-bs-scroll='true' tabindex='-1' id='offcanvasCart' aria-labelledby='offcanvasExampleLabel' aria-controls='offcanvasWithBothOptions'>";
            $off_canvas .= "<div class='offcanvas-header'>";
                $off_canvas .= "<h5 class='offcanvas-title' id='offcanvasExampleLabel'>Mon Panier</h5>";
                $off_canvas .= "<button type='button' class='btn-close' data-bs-dismiss='offcanvas' aria-label='Close'></button>";
            $off_canvas .= "</div>";
            $off_canvas .= "<div class='offcanvas-body'>";
                $off_canvas .= $this->displayCart();
            $off_canvas .= "</div>";
        $off_canvas .= "</article>";
        return $off_canvas;
    }

    public function displayCart() {
        $output = '';
        if(empty($this->cart)) {
            return "<p>Votre panier est vide</p>
            <a href='".RACINE_SITE."index.php?page=products' class='btn btn-primary'>Découvrir nos produits</a>";
        }
        $output .= "<article class='d-flex flex-column justify-content-between align-items-center h-100'>";
            $output .= "<ul class='list-group list-group-flush'>";
            foreach($this->cart as $id => $product) {
                $quantity = $product['quantity'];
                global $pdo;
                $ps = new ProduitRepo($pdo);
                $product = $ps->read_one($id);
                $data = $product->get_all_data();
                $data['quantity'] = $quantity;
                $this->total += $data['prix'] * $quantity;

                $output .= "<li class='list-group-item d-flex justify-content-between align-items-center'>";
                    $card = new Card($data);
                    $output .= $card->card_in_cart();
                $output .= "</li>";
            }
            $output .= "</ul>";
                
          
            $output .= "<aside class='d-flex flex-column justify-content-between align-items-center'>";
                $output .= "<p><strong>Total: ".$this->total." €</strong></p>";
                $output .= "<p>Nombre d'articles: ".$this->count."</p>";

                $output .= "<div class='d-flex justify-content-center mb-3'>";
                    $output .= "<a href='".RACINE_SITE."index.php?page=cart.php' class='btn btn-primary m-1'>Voir le panier</a>";
                    $output .= "<form action='controllers/cart/destroy.php' method='post'>";
                        $output .= "<button type='submit' class='btn btn-danger m-1'>Vider le panier</button>";
                    $output .= "</form>";
                $output .= "</div>";

                $output .="<div>";
                    $output .= "<a href='".RACINE_SITE."index.php?page=checkout.php' type='button' class='btn btn-success'>Commander</a>";
                $output .= "</div>";

            $output .= "</aside>";
        $output .= "</article>";
        return $output;
        
    }
}
