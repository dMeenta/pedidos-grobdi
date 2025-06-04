<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bases extends Model
{
    protected $table = 'bases';

        public function PresentacionFarmaceutica() // Método en minúsculas y singular
    {
        return $this->belongsTo(PresentacionFarmaceutica::class, 'presentacionfarmaceutica_id'); // Relación con la tabla 'unidad_de_medida'
    }
    public static function lista(){
        $bases = [
            'GOMITAS'=>[
                'formula'=>'',
                'clasificacion'=>[
                    'GOMITAS BASE'=>[
                        'gel base bloom 280'=>[
                            'cantidad'=>21,
                            'unidad medida'=>'G',
                        ],
                        'Jarabe base litro'=>[
                            'cantidad'=>85,
                            'unidad medida'=>'ML',
                        ],
                        'Agua destilada'=>[
                            'cantidad'=>27,
                            'unidad medida'=>'ML',
                        ],
                        'Glucosa liquida'=>[
                            'cantidad'=>55,
                            'unidad medida'=>'G',
                        ],
                        'Acido citrico'=>[
                            'cantidad'=>1.3,
                            'unidad medida'=>'G',
                        ],
                        'Metilparabeno'=>[
                            'cantidad'=>0.18,
                            'unidad medida'=>'G',
                        ],
                        'Esencia fresa'=>[
                            'cantidad'=>0.2,
                            'unidad medida'=>'ML',
                        ],
                        'Colorante rojo'=>[
                            'cantidad'=>0.1,
                            'unidad medida'=>'G',
                        ],
                        'Almidon de maiz'=>[
                            'cantidad'=>1.5,
                            'unidad medida'=>'G',
                        ],
                        'POTE DE GOMA PEAD X 225 G + TAPA + LAINA250G'=>[
                            'cantidad'=>1,
                            'unidad medida'=>'UND',
                        ],
                        'Precinto de gomas'=>[
                            'cantidad'=>1,
                            'unidad medida'=>'UND',
                        ],
                        'ETIQ AUTOADH METALIZADO MATTE 7.2X21.5 CM'=>[
                            'cantidad'=>1,
                            'unidad medida'=>'UND',
                        ],
                    ],
                    'GOMITAS BASE SIN AZUCAR'=>[
                        'gel base bloom 280'=>[
                            'cantidad'=>21,
                            'unidad medida'=>'G',
                        ],
                        'Sorbitol'=>[
                            'cantidad'=>85,
                            'unidad medida'=>'ML',
                        ],
                        'Agua destilada'=>[
                            'cantidad'=>27,
                            'unidad medida'=>'ML',
                        ],
                        'Glucosa liquida'=>[
                            'cantidad'=>55,
                            'unidad medida'=>'G',
                        ],
                        'Acido citrico'=>[
                            'cantidad'=>1.3,
                            'unidad medida'=>'G',
                        ],
                        'Metilparabeno'=>[
                            'cantidad'=>0.18,
                            'unidad medida'=>'G',
                        ],
                        'Esencia fresa'=>[
                            'cantidad'=>0.2,
                            'unidad medida'=>'ML',
                        ],
                        'Colorante rojo'=>[
                            'cantidad'=>0.1,
                            'unidad medida'=>'G',
                        ],
                        'Almidon de maiz'=>[
                            'cantidad'=>1.5,
                            'unidad medida'=>'G',
                        ],
                        'POTE DE GOMA PEAD X 225 G + TAPA + LAINA250G'=>[
                            'cantidad'=>1,
                            'unidad medida'=>'UND',
                        ],
                        'Precinto de gomas'=>[
                            'cantidad'=>1,
                            'unidad medida'=>'UND',
                        ],
                        'ETIQ AUTOADH METALIZADO MATTE 7.2X21.5 CM'=>[
                            'cantidad'=>1,
                            'unidad medida'=>'UND',
                        ],
                    ],
                ]
            ],
            'CAPSULAS'=>[
                'formula'=>'a * 30',
                'clasificacion'=>[
                    'CAPSULAS BASE'=>[
                        'LACTOSA MONOHIDRATADA'=>[
                            'cantidad'=>7.5,
                            'unidad medida'=>'G',
                        ],
                        'CAPSULA R/N  NUMERO 0'=>[
                            'cantidad'=>30,
                            'unidad medida'=>'UND',
                        ],
                        'FRASCO CAPSULERO 30'=>[
                            'cantidad'=>1,
                            'unidad medida'=>'UND',
                        ],
                        'BOLSA DE POLITILENO'=>[
                            'cantidad'=>1,
                            'unidad medida'=>'UND',
                        ],
                        'PRECINTO DE CAPSULAS'=>[
                            'cantidad'=>1,
                            'unidad medida'=>'UND',
                        ],
                    ]
                ],
            ],
            'JARABE'=>[
                'formula'=>'',
                'clasificacion'=>[
                    'jarabe de base X 150 ML'=>[
                        'AGUA DESTILADA'=>[
                            'cantidad'=>75,
                            'unidad medida'=>'G',
                        ],
                        'AZUCAR BLANCA'=>[
                            'cantidad'=>120,
                            'unidad medida'=>'G',
                        ],
                        'COLORANTE ROJO'=>[
                            'cantidad'=>0.1,
                            'unidad medida'=>'G',
                        ],
                        'ESENCIA FRESA'=>[
                            'cantidad'=>0.2,
                            'unidad medida'=>'ML',
                        ],
                        'METILPARABENO'=>[
                            'cantidad'=>0.15,
                            'unidad medida'=>'G',
                        ],
                        'FRASCO 150ML AMBAR VIDRIO'=>[
                            'cantidad'=>1,
                            'unidad medida'=>'UND',
                        ],
                        'VASO DOSIFICADOR X 15 ML'=>[
                            'cantidad'=>1,
                            'unidad medida'=>'UND',
                        ],
                        'CAJA DE JARABE CON DISEÑO'=>[
                            'cantidad'=>1,
                            'unidad medida'=>'UND',
                        ],
                        'etiqueta jarabe'=>[
                            'cantidad'=>1,
                            'unidad medida'=>'UND',
                        ],
                    ],
                    'jarabe de base para omega 3 X 150 ML'=>[
                        'AGUA DESTILADA'=>[
                            'cantidad'=>30,
                            'unidad medida'=>'g',
                        ],
                        'JARABE LYCASIN'=>[
                            'cantidad'=>120,
                            'unidad medida'=>'g',
                        ],
                        'ESENCIA PIÑA'=>[
                            'cantidad'=>0.3,
                            'unidad medida'=>'g',
                        ],
                        'ESENCIA MANDARINA'=>[
                            'cantidad'=>0.25,
                            'unidad medida'=>'G',
                        ],
                        'METILPARABENO'=>[
                            'cantidad'=>0.225,
                            'unidad medida'=>'g',
                        ],
                        'FRASCO 150ML AMBAR VIDRIO'=>[
                            'cantidad'=>1,
                            'unidad medida'=>'UND',
                        ],
                        'VASO DOSIFICADOR X 15 ML'=>[
                            'cantidad'=>1,
                            'unidad medida'=>'UND',
                        ],
                        'CAJA DE JARABE CON DISEÑO'=>[
                            'cantidad'=>1,
                            'unidad medida'=>'UND',
                        ],
                        'etiqueta jarabe'=>[
                            'cantidad'=>1,
                            'unidad medida'=>'UND',
                        ],
                    ],
                    'jarabe de base SIN AZUCAR X 150 ML'=>[
                        'AGUA DESTILADA'=>[
                            'cantidad'=>75,
                            'unidad medida'=>'g',
                        ],
                        'SORBITOL'=>[
                            'cantidad'=>85,
                            'unidad medida'=>'g',
                        ],
                        'COLORANTE ROJO'=>[
                            'cantidad'=>0.1,
                            'unidad medida'=>'g',
                        ],
                        'ESENCIA FRESA'=>[
                            'cantidad'=>0.2,
                            'unidad medida'=>'ML',
                        ],
                        'METILPARABENO'=>[
                            'cantidad'=>0.15,
                            'unidad medida'=>'G',
                        ],
                        'FRASCO 150ML AMBAR VIDRIO'=>[
                            'cantidad'=>1,
                            'unidad medida'=>'UND',
                        ],
                        'VASO DOSIFICADOR X 15 ML'=>[
                            'cantidad'=>1,
                            'unidad medida'=>'UND',
                        ],
                        'CAJA DE JARABE CON DISEÑO'=>[
                            'cantidad'=>1,
                            'unidad medida'=>'UND',
                        ],
                        'etiqueta jarabe'=>[
                            'cantidad'=>1,
                            'unidad medida'=>'UND',
                        ],
                    ],
                    'JARABE BASE 1 L'=>[
                        'AZUCAR'=>[
                            'cantidad'=>800,
                            'unidad medida'=>'G',
                        ],
                        'METILPARABENO'=>[
                            'cantidad'=>1,
                            'unidad medida'=>'G',
                        ],
                        'AGUA DESTILADA'=>[
                            'cantidad'=>500,
                            'unidad medida'=>'ML',
                        ],
                        'BOLSA DE POLITILENO'=>[
                            'cantidad'=>6,
                            'unidad medida'=>'UND',
                        ],
                    ],
                ],
            ],
            'SHAMPOO'=>[
                'formula'=>'',
                'clasificacion'=>[
                    'SHAMPOO BASE SIN SAL'=>[
                        'TEXAPON N70'=>[
                            'cantidad'=>208,
                            'unidad medida'=>'G',
                        ],
                        'COMPERLAND KD ( DIETANOLAMINA DE COCO )'=>[
                            'cantidad'=>100,
                            'unidad medida'=>'G',
                        ],
                        'METILPARABENO'=>[
                            'cantidad'=>2,
                            'unidad medida'=>'G',
                        ],
                        'PROPILENGLICOL'=>[
                            'cantidad'=>100,
                            'unidad medida'=>'G',
                        ],
                        'AGUA DETILADA'=>[
                            'cantidad'=>557,
                            'unidad medida'=>'ML',
                        ],
                        'ACIDO LACTICO'=>[
                            'cantidad'=>2,
                            'unidad medida'=>'G',
                        ],
                        'CREMA UNIBASE 1 KG'=>[
                            'cantidad'=>60,
                            'unidad medida'=>'G',
                        ],
                        'BOLSA DE POLITILENO'=>[
                            'cantidad'=>6,
                            'unidad medida'=>'UND',
                        ],
                    ],
                    'SHAMPOO DE KETOCONAZOL 2%'=>[
                        'TEXAPON N70'=>[
                            'cantidad'=>208,
                            'unidad medida'=>'G',
                        ],
                        'COMPERLAND KD ( DIETANOLAMINA DE COCO )'=>[
                            'cantidad'=>90,
                            'unidad medida'=>'G',
                        ],
                        'METILPARABENO'=>[
                            'cantidad'=>2,
                            'unidad medida'=>'G',
                        ],
                        'PROPILENGLICOL'=>[
                            'cantidad'=>100,
                            'unidad medida'=>'G',
                        ],
                        'AGUA DETILADA'=>[
                            'cantidad'=>586,
                            'unidad medida'=>'ML',
                        ],
                        'ACIDO LACTICO'=>[
                            'cantidad'=>2,
                            'unidad medida'=>'G',
                        ],
                        'CREMA UNIBASE 1 KG'=>[
                            'cantidad'=>60,
                            'unidad medida'=>'G',
                        ],
                        'KETOCONAZOL'=>[
                            'cantidad'=>20,
                            'unidad medida'=>'G',
                        ],
                        'COLORANTE ROJO'=>[
                            'cantidad'=>0.05,
                            'unidad medida'=>'G',
                        ],
                        'BOLSA DE POLITILENO'=>[
                            'cantidad'=>6,
                            'unidad medida'=>'UND',
                        ],
                    ],
                    'SHAMPOO BASE PARA ACIDO SALICILICO'=>[
                        'TEXAPON N70'=>[
                            'cantidad'=>330,
                            'unidad medida'=>'G',
                        ],
                        'COMPERLAND KD ( DIETANOLAMINA DE COCO )'=>[
                            'cantidad'=>30,
                            'unidad medida'=>'G',
                        ],
                        'METILPARABENO'=>[
                            'cantidad'=>1.5,
                            'unidad medida'=>'G',
                        ],
                        'CLORURO DE SODIO'=>[
                            'cantidad'=>5,
                            'unidad medida'=>'G',
                        ],
                        'AGUA DETILADA'=>[
                            'cantidad'=>550,
                            'unidad medida'=>'ML',
                        ],
                        'ACIDO CITRICO'=>[
                            'cantidad'=>0.75,
                            'unidad medida'=>'G',
                        ],
                        'EDTA'=>[
                            'cantidad'=>0.5,
                            'unidad medida'=>'G',
                        ],
                        'COCOAMIDOPROPILBETAINA'=>[
                            'cantidad'=>70,
                            'unidad medida'=>'ML',
                        ],
                        'BOLSA DE POLITILENO'=>[
                            'cantidad'=>6,
                            'unidad medida'=>'UND',
                        ],
                    ],
                    'SHAMPOO ANTICASPA'=>[
                        'TEXAPON N70'=>[
                            'cantidad'=>150,
                            'unidad medida'=>'G',
                        ],
                        'AGUA DETILADA'=>[
                            'cantidad'=>680,
                            'unidad medida'=>'ML',
                        ],
                        'METILPARABENO'=>[
                            'cantidad'=>1.7,
                            'unidad medida'=>'G',
                        ],
                        'COMPERLAND KD ( DIETANOLAMINA DE COCO )'=>[
                            'cantidad'=>40,
                            'unidad medida'=>'G',
                        ],
                        'ESTERPOL'=>[
                            'cantidad'=>40,
                            'unidad medida'=>'G',
                        ],
                        'ALANTOINA'=>[
                            'cantidad'=>10,
                            'unidad medida'=>'G',
                        ],
                        'PROPILENGLICOL'=>[
                            'cantidad'=>27,
                            'unidad medida'=>'G',
                        ],
                        'CLORURO DE SODIO'=>[
                            'cantidad'=>9,
                            'unidad medida'=>'G',
                        ],
                        'PIRITIONATO DE ZINC'=>[
                            'cantidad'=>40,
                            'unidad medida'=>'ML',
                        ],
                        'BOLSA DE POLITILENO'=>[
                            'cantidad'=>6,
                            'unidad medida'=>'UND',
                        ],
                    ],
                ],
            ],
            'CREMA'=>[
                'formula'=>'',
                'clasificacion'=>[
                    'CREMA LANETTE  1 KG'=>[
                        'LANTTE N'=>[
                            'cantidad'=>240,
                            'unidad medida'=>'G',
                        ],
                        'CETIOL V'=>[
                            'cantidad'=>160,
                            'unidad medida'=>'G',
                        ],
                        'PROPILPARABENO'=>[
                            'cantidad'=>0.5,
                            'unidad medida'=>'G',
                        ],
                        'SORBITOL'=>[
                            'cantidad'=>70,
                            'unidad medida'=>'G',
                        ],
                        'AGUA DESTILADA'=>[
                            'cantidad'=>530,
                            'unidad medida'=>'G',
                        ],
                        'METILPARABENO'=>[
                            'cantidad'=>1,
                            'unidad medida'=>'G',
                        ],
                        'BOLSA DE POLITILENO'=>[
                            'cantidad'=>6,
                            'unidad medida'=>'UND',
                        ],
                    ],
                    'CREMA NO IONICA  1KG'=>[
                        'POLAWAX'=>[
                            'cantidad'=>120,
                            'unidad medida'=>'G',
                        ],
                        'ACEITE MINERAL'=>[
                            'cantidad'=>40,
                            'unidad medida'=>'ML',
                        ],
                        'ALCOHOL CETILICO'=>[
                            'cantidad'=>40,
                            'unidad medida'=>'G',
                        ],
                        'PROPILPARABENO'=>[
                            'cantidad'=>0.5,
                            'unidad medida'=>'G',
                        ],
                        'GLICERINA'=>[
                            'cantidad'=>100,
                            'unidad medida'=>'G',
                        ],
                        'METILPARABENO'=>[
                            'cantidad'=>1,
                            'unidad medida'=>'G',
                        ],
                        'AGUA DESTILADA'=>[
                            'cantidad'=>699,
                            'unidad medida'=>'ML',
                        ],
                        'BOLSA DE POLITILENO'=>[
                            'cantidad'=>6,
                            'unidad medida'=>'UND',
                        ],
                    ],
                    'CREMA UNIBASE 1 KG'=>[
                        'ALCOHOL CETILICO'=>[
                            'cantidad'=>90,
                            'unidad medida'=>'G',
                        ],
                        'ALCOHOL ESTEARILICO'=>[
                            'cantidad'=>40,
                            'unidad medida'=>'G',
                        ],
                        'PROPILPARABENO'=>[
                            'cantidad'=>1,
                            'unidad medida'=>'G',
                        ],
                        'GLICERINA'=>[
                            'cantidad'=>100,
                            'unidad medida'=>'G',
                        ],
                        'PROPILENGLICOL'=>[
                            'cantidad'=>40,
                            'unidad medida'=>'G',
                        ],
                        'LAURIL SULATO DE SODIO'=>[
                            'cantidad'=>10,
                            'unidad medida'=>'G',
                        ],
                        'METILPARABENO'=>[
                            'cantidad'=>1,
                            'unidad medida'=>'G',
                        ],
                        'AGUA DESTILADA'=>[
                            'cantidad'=>718,
                            'unidad medida'=>'ML',
                        ],
                        'BOLSA DE POLITILENO'=>[
                            'cantidad'=>6,
                            'unidad medida'=>'UND',
                        ],
                    ],
                ]
            ],
            'VASELINA'=>[
                'formula'=>''
            ],
            'JABON'=>[
                'formula',
                'clasificacion'=>[
                    'JABON LIQUIDO DE AVENA'=>[
                        'TEXAPON N70'=>[
                            'cantidad'=>200,
                            'unidad medida'=>'G',
                        ],
                        'AGUA DESTILADA'=>[
                            'cantidad'=>861,
                            'unidad medida'=>'ML',
                        ],
                        'METILPARABENO'=>[
                            'cantidad'=>2.5,
                            'unidad medida'=>'G',
                        ],
                        'COMPERLAND KD ( DIETANOLAMINA DE COCO )'=>[
                            'cantidad'=>70,
                            'unidad medida'=>'G',
                        ],
                        'ESTERPOL'=>[
                            'cantidad'=>10,
                            'unidad medida'=>'G',
                        ],
                        'PROPILENGLICOL'=>[
                            'cantidad'=>27,
                            'unidad medida'=>'G',
                        ],
                        'CLORURO DE SODIO'=>[
                            'cantidad'=>5,
                            'unidad medida'=>'G',
                        ],
                        'ACIDO CITRICO'=>[
                            'cantidad'=>1,
                            'unidad medida'=>'G',
                        ],
                        'EXTRACTO DE AVENA'=>[
                            'cantidad'=>40,
                            'unidad medida'=>'ML',
                        ],
                        'BOLSA DE POLITILENO'=>[
                            'cantidad'=>6,
                            'unidad medida'=>'UND',
                        ],
                    ],
                    'JABON PH NEUTRO'=>[
                        'TEXAPON N70'=>[
                            'cantidad'=>113.1,
                            'unidad medida'=>'G',
                        ],
                        'COMPERLAND KD ( DIETANOLAMINA DE COCO )'=>[
                            'cantidad'=>22.6,
                            'unidad medida'=>'G',
                        ],
                        'AGUA DESTILADA'=>[
                            'cantidad'=>842,
                            'unidad medida'=>'ML',
                        ],
                        'BRONIDOX'=>[
                            'cantidad'=>1.1,
                            'unidad medida'=>'G',
                        ],
                        'ACIDO LACTICO'=>[
                            'cantidad'=>2,
                            'unidad medida'=>'G',
                        ],
                        'UNIBASE'=>[
                            'cantidad'=>16.6,
                            'unidad medida'=>'G',
                        ],
                        'CLORURO DE SODIO'=>[
                            'cantidad'=>20,
                            'unidad medida'=>'ML',
                        ],
                        'BOLSA DE POLITILENO'=>[
                            'cantidad'=>6,
                            'unidad medida'=>'UND',
                        ],
                    ],
                    'JABON DE PERMETRINA 1L'=>[
                        'TEXAPON N70'=>[
                            'cantidad'=>157.8,
                            'unidad medida'=>'G',
                        ],
                        'AGUA DESTILADA'=>[
                            'cantidad'=>750,
                            'unidad medida'=>'ML',
                        ],
                        'METILPARABENO'=>[
                            'cantidad'=>1.78,
                            'unidad medida'=>'G',
                        ],
                        'COMPERLAND KD ( DIETANOLAMINA DE COCO )'=>[
                            'cantidad'=>52.5,
                            'unidad medida'=>'G',
                        ],
                        'ESTERPOL'=>[
                            'cantidad'=>42,
                            'unidad medida'=>'G',
                        ],
                        'PROPILENGLICOL'=>[
                            'cantidad'=>28.3,
                            'unidad medida'=>'G',
                        ],
                        'CLORURO DE SODIO'=>[
                            'cantidad'=>9.3,
                            'unidad medida'=>'G',
                        ],
                        'PERMETRINA'=>[
                            'cantidad'=>10.5,
                            'unidad medida'=>'G',
                        ],
                        'BOLSA DE POLITILENO'=>[
                            'cantidad'=>6,
                            'unidad medida'=>'UND',
                        ],
                    ],
                ],
            ],
            'GEL'=>[
                'formula'=>'',
                'clasificacion'=>[
                    'GEL BASE CARBOPOL 1%'=>[
                        'CARBOPOL ULTREX'=>[
                            'cantidad'=>10,
                            'unidad medida'=>'G',
                        ],
                        'METILPARABENO'=>[
                            'cantidad'=>1,
                            'unidad medida'=>'G',
                        ],
                        'TRIETANOLAMINA'=>[
                            'cantidad'=>0.8,
                            'unidad medida'=>'G',
                        ],
                        'AGUA DESTILADA'=>[
                            'cantidad'=>969,
                            'unidad medida'=>'ML',
                        ],
                        'BOLSA DE POLITILENO'=>[
                            'cantidad'=>3,
                            'unidad medida'=>'UND',
                        ],
                    ],
                    'GEL DE NATROSOL 1KG'=>[
                        'NATROSOL ( HIDROXIETILCELULOSA )'=>[
                            'cantidad'=>25,
                            'unidad medida'=>'G',
                        ],
                        'GLICERINA'=>[
                            'cantidad'=>10,
                            'unidad medida'=>'G',
                        ],
                        'METILPARABENO'=>[
                            'cantidad'=>1,
                            'unidad medida'=>'G',
                        ],
                        'AGUA DESTILADA'=>[
                            'cantidad'=>969,
                            'unidad medida'=>'ML',
                        ],
                        'BOLSA DE POLITILENO'=>[
                            'cantidad'=>3,
                            'unidad medida'=>'UND',
                        ],
                    ],
                    'GEL DESINFECTANTE'=>[
                        'ALOE VERA'=>[
                            'cantidad'=>10,
                            'unidad medida'=>'ML',
                        ],
                        'GLICERINA'=>[
                            'cantidad'=>30,
                            'unidad medida'=>'G',
                        ],
                        'ALCOHOL ETILICO'=>[
                            'cantidad'=>720,
                            'unidad medida'=>'ML',
                        ],
                        'GEL BASE CARBOPOL'=>[
                            'cantidad'=>300,
                            'unidad medida'=>'G',
                        ],
                        'BOLSA DE POLITILENO'=>[
                            'cantidad'=>6,
                            'unidad medida'=>'UND',
                        ],
                    ],
                ]
            ],
            'PAPELILLOS'=>[
                'formula'=>''
            ],
            'SOLUCION'=>[
                'formula'=>''
            ],
            'POLVO'=>[
                'formula'=>''
            ],
        ];
        return $bases;
    }
}
