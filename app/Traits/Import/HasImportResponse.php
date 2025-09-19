<?php

namespace App\Traits\Import;

trait HasImportResponse
{
    public $data;
    public $key;
    
    /**
     * Establece los datos de respuesta de la importación
     * 
     * Este método configura el mensaje de respuesta y el estado (clave) que se utilizará
     * para mostrar feedback al usuario sobre el resultado de la operación de importación.
     * 
     * @param string $message El mensaje descriptivo de la respuesta
     * @param string $status El estado de la respuesta (por defecto 'success')
     * @return void
     */
    protected function setResponse(string $message, string $status = 'success'): void
    {
        $this->data = $message;
        $this->key = $status;
    }
    
    /**
     * Establece una respuesta de éxito para la importación
     * 
     * Este método configura un mensaje de éxito que indica que la operación de importación
     * se completó correctamente. Utiliza el estado 'success' por defecto.
     * 
     * @param string $message El mensaje descriptivo del éxito de la operación
     * @return void
     */
    protected function setSuccessResponse(string $message): void
    {
        $this->setResponse($message, 'success');
    }
    
    /**
     * Establece una respuesta de advertencia para la importación
     * 
     * Este método configura un mensaje de advertencia que indica que la operación de importación
     * se completó pero con algunas observaciones o condiciones especiales que el usuario
     * debe tener en cuenta. Utiliza el estado 'warning'.
     * 
     * @param string $message El mensaje descriptivo de la advertencia
     * @return void
     */
    protected function setWarningResponse(string $message): void
    {
        $this->setResponse($message, 'warning');
    }
    
    /**
     * Establece una respuesta de error para la importación
     * 
     * Este método configura un mensaje de error que indica que la operación de importación
     * falló o encontró un problema crítico que impidió su completación. Utiliza el estado 'danger'.
     * 
     * @param string $message El mensaje descriptivo del error ocurrido
     * @return void
     */
    protected function setErrorResponse(string $message): void
    {
        $this->setResponse($message, 'danger');
    }
}
