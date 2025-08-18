<?php

namespace App\Models;

class Distritos_zonas
{
    public static function zonificar($distrito)
    {
        $zona_norte = [
            "Callao",
            "Breña",
            "Pueblo Libre",
            "Carabayllo",
            "Comas",
            "Independencia",
            "Los Olivos",
            "Puente Piedra",
            "San Martín de Porres",
            "San Miguel",
            "Ventanilla"
        ];
          
        $zona_centro = [
            "Cercado de Lima",
            "El Agustino",
            "Jesús María",
            "JESÃºS MARÃ­A",
            "La Victoria",
            "Lince",
            "Santa Anita",
            "Rímac",
            "Ate Vitarte",
            "Ate",
            "San Juan de Lurigancho",
            "SJL",
            "San Luis",
            "La Molina",
            "Santa Anita",
            
        ];
          
        $zona_sur = [
            "Miraflores",
            "Magdalena",
            "San Isidro",
            "Barranco",
            "Chorrillos",
            "San Borja",
            "Villa maria del triunfo",
            "San Juan de Miraflores",
            "Surco",
            "Surquillo",
            "Villa El Salvador",
        ];
        $recojo_tienda = [
            "RECOJO EN TIENDA",
            "RECOJO TIENDA",
            "RETIRO EN TIENDA",
        ];
        if (in_array(strtolower($distrito), array_map('strtolower', $zona_norte)))
        {
            return 2;
        }
        else if (in_array(strtolower($distrito), array_map('strtolower', $zona_centro)))
        {
            return 3;
        }
        else if (in_array(strtolower($distrito), array_map('strtolower', $zona_sur)))
        {
            return 4;
        }
        else if (in_array(strtolower($distrito), array_map('strtolower', $recojo_tienda)))
        {
            return 5;
        }
        else {
            return 1;
        }
    }
}

