<?php

class Modal
{
    private array $data = 
    [
        'id' => '',
        'class' => '',
        'title' => '',
        'body' => '',
        'footer' => '',
    ];

    public function __construct(array $data)
    {
        $this->set_value_of('data', $data);
    }

    public function set_value_of($attribut, $value)
    {
        $this->data[$attribut] = $value;
    }

    public function get_value_of($attribut)
    {
        return $this->data[$attribut] ?? null;
    }


    public function modal_content() : string
    {
        $modal = "<div class='modal fade' id='{$this->get_value_of('data')['id']}' tabindex='-1' aria-labelledby='modal' aria-hidden='true'>";

            $modal .= "<div class='modal-dialog {$this->get_value_of('data')['class']}'>";

                $modal .= "<div class='modal-content bg-dark border-0'>";

                    $modal .= "<div class='modal-header border-0'>";
                        $modal .= "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
                    $modal .= "</div>";

                    $modal .= "<div class='modal-body'>{$this->get_value_of('data')['body']}</div>";

                    
                    if(!empty($this->get_value_of('data')['footer'])){
                    $modal .= "<div class='modal-footer bg-dark text-light border-0'>";
                        $modal .= $this->get_value_of('data')['footer'];
                    $modal .= "</div>";
                    }

                $modal .= "</div>";

            $modal .= "</div>";
        $modal .= "</div>";
        return $modal;
    }

    public function modal_trigger()
    {
        $btn = "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#{$this->get_value_of('data')['id']}'>";
            $btn .= $this->get_value_of('data')['title'];
        $btn .= "</button>";
        return $btn;
    }
}