<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DynamicInput extends Component
{
    public $etiqueta;
    public $tipo;
    public $placeholder;
    public $name;
    public $value;

    /**
     * Crear una nueva instancia del componente.
     *
     * @param string $etiqueta Texto de la etiqueta del input
     * @param string $tipo Tipo de input (por ejemplo, text, email, password)
     * @param string $placeholder Texto de placeholder para el input
     * @param string $name Nombre del campo de input para el formulario
     * @param string $value Valor inicial del campo de input
     */
    public function __construct($etiqueta, $tipo = 'text', $placeholder = 'Introduce el valor...', $name = 'inputName', $value = '')
    {
        $this->etiqueta = $etiqueta;
        $this->tipo = $tipo;
        $this->placeholder = $placeholder;
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * Obtén la vista o contenido del componente.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.dynamic-input');
    }
}
