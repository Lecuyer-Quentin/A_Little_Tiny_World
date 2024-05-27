<?php

class Produit
{
    private int $id;
    private string $nom;
    private float $prix;
    private bool $inStock;
    private Categorie $categorie;
    private string $date_ajout;

    // Optional
    private ?string $image;
    private ?string $description;
    private ?Special $special;




    public function __construct ($id, $nom, $prix, $inStock, $categorie, $date_ajout,
                                     $image = null, $description = null, $special = null)
    {
        $this->set_value_of('id', $id);
        $this->set_value_of('nom', $nom);
        $this->set_value_of('prix', $prix);
        $this->set_value_of('inStock', (bool)$inStock); // Convert to boolean (0 => false, 1 => true)
        $this->set_value_of('categorie', $categorie);
        $this->set_value_of('date_ajout', $date_ajout);
        $this->set_value_of('image', $image);
        $this->set_value_of('description', $description);
        $this->set_value_of('special', $special);

    }

    public function set_value_of($attribut, $valeur)
    {
        if(property_exists($this, $attribut) ){
            $this->$attribut = $valeur;
        }
    }

    public function get_all_data()
    {
        $this->image = 'images/products/' . $this->image;
        return get_object_vars($this);
    }

    public function get_value_of($attribut)
    {
        if(property_exists($this, $attribut)){
            if($attribut == 'image')
            {
                return 'images/products/' . $this->$attribut;
            } else {
                return $this->$attribut;
            }
        }
    }

    public function __toString()
    {
        return $this->nom;
    }

    public function accordion()
    {
        $data = $this->get_all_data();
        $data = array_filter($data, function($key){
            return $key != 'id' && $key != 'categorie' && $key != 'date_ajout' && $key != 'image' && $key != 'special' && $key != 'inStock';
        }, ARRAY_FILTER_USE_KEY);
        $data['prix'] = $data['prix'] . ' €';

        $accordion = '<div class="accordion accordion-flush" style="width: 22rem; id="accordion_product">';
            foreach($data as $key => $value){
                $accordion .= '<div class="accordion-item">';
                    $accordion .= '<h2 class="accordion-header" id="heading_' . $key . '">';
                        $accordion .= '<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_' . $key . '" aria-expanded="true" aria-controls="collapse_' . $key . '">';
                            $accordion .= ucfirst($key);
                        $accordion .= '</button>';
                    $accordion .= '</h2>';
                    $accordion .= '<div id="collapse_' . $key . '" class="accordion-collapse collapse" aria-labelledby="heading_' . $key . '" data-bs-parent="#accordion_product">';
                        $accordion .= '<div class="accordion-body">';
                            $accordion .= $value;
                        $accordion .= '</div>';
                    $accordion .= '</div>';
                $accordion .= '</div>';
            }
        $accordion .= '</div>';
        return $accordion;
    }

}