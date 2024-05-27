<?php

class Form
{
    private array $data = [
        'header' => [],
        'inputs' => [],
        'footer' => [],
    ];

    public function __construct($data)
    {
        $this->set_value_of('data', $data);
    }

    public function set_value_of($attribut, $value)
    {
        $this->data[$attribut] = $value;
    }

    public function get_value_of($attribut)
    {
        return $this->data[$attribut];
    }

    private function generate_header()
    {
        if (isset($this->get_value_of('data')['header'])) {
            foreach ($this->get_value_of('data')['header'] as $item) {
                $header = '<' . $item['type'] . '>' . $item['line'] . '</' . $item['type'] . '>';
                $headers[] = $header;
            }
            if (isset($headers)) {
                return implode("", $headers);
            }
        }
    }

    private function generate_footer()
    {
        if (isset($this->get_value_of('data')['footer'])) {
            foreach ($this->get_value_of('data')['footer'] as $item) {
                $footer = '<' . $item['type'] . '>' . $item['line'] . '</' . $item['type'] . '>';
                $footers[] = $footer;
            }
            if (isset($footers) && !empty($footers) && is_array($footers)) {
                return implode("", $footers);
            }
        } else {
            return '';
        }
    }

    private function generate_inputs() {
        $inputs = [];
        if (isset($this->get_value_of('data')['inputs'])) {
            foreach ($this->get_value_of('data')['inputs'] as $item) {
                $input = "<div class='form-group' id='input_" . $item['name'] . "'>";
                if (isset($item['label'])) {
                    $input .= "<label for='{$item['name']}'>{$item['label']}</label><br>";
                }

                $required = $item['required'] ? 'required' : '';
                $accept = isset($item['accept']) ? "accept='{$item['accept']}'" : '';
                $checked = isset($item['checked']) ? 'checked' : '';
                $value = isset($item['value']) ? $item['value'] : '';

                switch ($item['type']) {
                    case 'select':
                        $input .= "<select name='{$item['name']}' class='form-control' $required>
                                    <option value=''>-- Choisir --</option>";
                        foreach ($item['options'] as $option) {
                            $input .= "<option value='{$option->get_value_of('id')}'>{$option->get_value_of('nom')}</option>";
                        }
                        $input .= "</select>";
                        break;

                    case 'number':
                        $input .= "<input type='number' name='{$item['name']}' 
                                        placeholder='{$item['placeholder']}' class='form-control' $required>";
                        break;

                    case 'file':
                        $input .= "<input type='file' name='{$item['name']}' class='form-control' $accept $required>";
                        break;

                    case 'password':
                        $input .= "<input type='password' name='{$item['name']}' 
                                        placeholder='{$item['placeholder']}' class='form-control' $required>";
                        break;

                    case 'hidden':
                        $input .= "<input type='hidden' name='{$item['name']}' value='{$item['value']}'>";
                        break;

                    case 'text':
                        $input .= "<input type='text' name='{$item['name']}' 
                                        placeholder='{$item['placeholder']}' class='form-control' $required>";
                        break;
                    case 'checkbox':
                        $input .= "<input type='checkbox' name='{$item['name']}' class='' $required $checked value='{$value}'>";
                        break;

                    default:
                        $input .= "<input type='{$item['type']}' name='{$item['name']}' 
                                        placeholder='{$item['placeholder']}' class='form-control' $required>";
                        break;
                }

                $input .= "</div>";
                $inputs[] = $input;
            }
        }
        return implode("<br>", $inputs);
    }

    public function generate_form()
    {
        $form = "<form 
                    method='" . ($this->get_value_of('data')['method'] ?? 'POST') . "'
                    action='" . ($this->get_value_of('data')['action'] ?? '') . "'
                    enctype='" . ($this->get_value_of('data')['enctype'] ?? 'application/x-www-form-urlencoded') . "'
                    class='form " . ($this->get_value_of('data')['class'] ?? '') . "' 
                    id='" . ($this->get_value_of('data')['id'] ?? '') . "'>";
                    
            $form .= "<div class=''>";
                $form .=$this->generate_header();
            $form .= "</div>";

            $form .= "<div class=''>";
                $form .=$this->generate_inputs();
            $form .= "</div>";

            $form .= "<div class=''>";
                $form .=$this->generate_footer();
            $form .= "</div>";

            $form .= "<div class='mt-3'>";
       
                $form .= "<button type='submit' class='btn btn-primary'>
                    " . ($this->get_value_of('data')['submit'] ?? 'Envoyer') . "
                    </button>";

            $form .= "</div>";

        $form .= "</form>";
        return $form;
    }
}