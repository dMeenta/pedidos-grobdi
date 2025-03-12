<?php

namespace App\Models;

class Distritos_zonas
{
    public static function zonificar($distrito)
    {
        $zona_norte = [
            "Callao",
            "Carabayllo",
            "Comas",
            "Independencia",
            "Los Olivos",
            "Magdalena",
            "Puente Piedra",
            "San Martín de Porres",
            "San Miguel",
        ];
          
        $zona_centro = [
            "Breña",
            "Cercado de Lima",
            "El Agustino",
            "Jesús María",
            "La Victoria",
            "Lince",
            "Miraflores",
            "Pueblo Libre",
            "Rímac",
            "San Juan de Lurigancho",
            "SJL",
            "Santa Anita",
            "San Isidro",
        ];
          
        $zona_sur = [
            "Ate",
            "Ate Vitarte",
            "Barranco",
            "Chorrillos",
            "La Molina",
            "San Borja",
            "San Juan de Miraflores",
            "San Luis",
            "Santa Anita",
            "Surco",
            "Surquillo",
            "Villa El Salvador",
        ];
        $recojo_tienda = [
            "RECOJO EN TIENDA",
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

