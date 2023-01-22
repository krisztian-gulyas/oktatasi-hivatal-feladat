<?php

// output: 470 (370 alappont + 100 többletpont)
$exampleData = [
    'valasztott-szak' => [
        'egyetem' => 'ELTE',
        'kar' => 'IK',
        'szak' => 'Programtervező informatikus'
    ],
    'erettsegi-eredmenyek' => [
        [
            'nev' => 'magyar nyelv és irodalom',
            'tipus' => 'közép',
            'eredmeny' => '70%'
        ],
        [
            'nev' => 'történelem',
            'tipus' => 'közép',
            'eredmeny' => '80%'
        ],
        [
            'nev' => 'matematika',
            'tipus' => 'emelt',
            'eredmeny' => '90%'
        ],
        [
            'nev' => 'angol nyelv',
            'tipus' => 'közép',
            'eredmeny' => '94%'
        ],
        [
            'nev' => 'informatika',
            'tipus' => 'közép',
            'eredmeny' => '95%'
        ]
    ],
    'tobbletpontok' => [
        [
            'kategoria' => 'Nyelvvizsga',
            'tipus' => 'B2',
            'nyelv' => 'angol'
        ],
        [
            'kategoria' => 'Nyelvvizsga',
            'tipus' => 'C1',
            'nyelv' => 'német'
        ]
    ]
];

// output: 476 (376 alappont + 100 többletpont)
$exampleData1 = [
    'valasztott-szak' => [
        'egyetem' => 'ELTE',
        'kar' => 'IK',
        'szak' => 'Programtervező informatikus'
    ],
    'erettsegi-eredmenyek' => [
        [
            'nev' => 'magyar nyelv és irodalom',
            'tipus' => 'közép',
            'eredmeny' => '70%'
        ],
        [
            'nev' => 'történelem',
            'tipus' => 'közép',
            'eredmeny' => '80%'
        ],
        [
            'nev' => 'matematika',
            'tipus' => 'emelt',
            'eredmeny' => '90%'
        ],
        [
            'nev' => 'angol nyelv',
            'tipus' => 'közép',
            'eredmeny' => '94%'
        ],
        [
            'nev' => 'informatika',
            'tipus' => 'közép',
            'eredmeny' => '95%'
        ],
        [
            'nev' => 'fizika',
            'tipus' => 'közép',
            'eredmeny' => '98%'
        ]
    ],
    'tobbletpontok' => [
        [
            'kategoria' => 'Nyelvvizsga',
            'tipus' => 'B2',
            'nyelv' => 'angol'
        ],
        [
            'kategoria' => 'Nyelvvizsga',
            'tipus' => 'C1',
            'nyelv' => 'német'
        ]
    ]
];

// output: hiba, nem lehetséges a pontszámítás a kötelező érettségi tárgyak hiánya miatt
$exampleData2 = [
    'valasztott-szak' => [
        'egyetem' => 'ELTE',
        'kar' => 'IK',
        'szak' => 'Programtervező informatikus'
    ],
    'erettsegi-eredmenyek' => [
        [
            'nev' => 'matematika',
            'tipus' => 'emelt',
            'eredmeny' => '90%'
        ],
        [
            'nev' => 'angol nyelv',
            'tipus' => 'közép',
            'eredmeny' => '94%'
        ],
        [
            'nev' => 'informatika',
            'tipus' => 'közép',
            'eredmeny' => '95%'
        ]
    ],
    'tobbletpontok' => [
        [
            'kategoria' => 'Nyelvvizsga',
            'tipus' => 'B2',
            'nyelv' => 'angol'
        ],
        [
            'kategoria' => 'Nyelvvizsga',
            'tipus' => 'C1',
            'nyelv' => 'német'
        ]
    ]
];

// output: hiba, nem lehetséges a pontszámítás a magyar nyelv és irodalom tárgyból elért 20% alatti eredmény miatt
$exampleData3 = [
    'valasztott-szak' => [
        'egyetem' => 'ELTE',
        'kar' => 'IK',
        'szak' => 'Programtervező informatikus'
    ],
    'erettsegi-eredmenyek' => [
        [
            'nev' => 'magyar nyelv és irodalom',
            'tipus' => 'közép',
            'eredmeny' => '15%'
        ],
        [
            'nev' => 'történelem',
            'tipus' => 'közép',
            'eredmeny' => '80%'
        ],
        [
            'nev' => 'matematika',
            'tipus' => 'emelt',
            'eredmeny' => '90%'
        ],
        [
            'nev' => 'angol nyelv',
            'tipus' => 'közép',
            'eredmeny' => '94%'
        ],
        [
            'nev' => 'informatika',
            'tipus' => 'közép',
            'eredmeny' => '95%'
        ]
    ],
    'tobbletpontok' => [
        [
            'kategoria' => 'Nyelvvizsga',
            'tipus' => 'B2',
            'nyelv' => 'angol'
        ],
        [
            'kategoria' => 'Nyelvvizsga',
            'tipus' => 'C1',
            'nyelv' => 'német'
        ]
    ]
];

/*\ MY EXAMPLEDATA \*/
/*\ Másik vszak vizsgálata, Hibás eredmény, hiányos tárgy vagy nem megfelelő \*/

$my_exampleData = [
    'valasztott-szak' => [
        'egyetem' => 'PPKE',
        'kar' => 'BTK',
        'szak' => 'Anglisztika'
    ],
    'erettsegi-eredmenyek' => [
        [
            'nev' => 'magyar nyelv és irodalom',
            'tipus' => 'közép',
            'eredmeny' => '20%'
        ],
        [
            'nev' => 'történelem',
            'tipus' => 'közép',
            'eredmeny' => '80%'
        ],
        [
            'nev' => 'matematika',
            'tipus' => 'emelt',
            'eredmeny' => '90%'
        ],
        [
            'nev' => 'angol nyelv',
            'tipus' => 'emelt',
            'eredmeny' => '94%'
        ]
    ],
    'tobbletpontok' => [
        [
            'kategoria' => 'Nyelvvizsga',
            'tipus' => 'B2',
            'nyelv' => 'angol'
        ],
        [
            'kategoria' => 'Nyelvvizsga',
            'tipus' => 'C1',
            'nyelv' => 'angol'
        ]
    ]
];
$my_exampleData1 = [
    'valasztott-szak' => [
        'egyetem' => 'PPKE',
        'kar' => 'BTK',
        'szak' => 'Anglisztika'
    ],
    'erettsegi-eredmenyek' => [
        [
            'nev' => 'magyar nyelv és irodalom',
            'tipus' => 'közép',
            'eredmeny' => '20%'
        ],
        [
            'nev' => 'történelem',
            'tipus' => 'közép',
            'eredmeny' => '80%'
        ],
        [
            'nev' => 'matematika',
            'tipus' => 'közép',
            'eredmeny' => '90%'
        ],
        [
            'nev' => 'angol nyelv',
            'tipus' => 'emelt',
            'eredmeny' => '94%'
        ]
    ],
    'tobbletpontok' => [
        [
            'kategoria' => 'Nyelvvizsga',
            'tipus' => 'B2',
            'nyelv' => 'spanyol'
        ]
    ],
];
$my_exampleData2 = [
    'valasztott-szak' => [
        'egyetem' => 'PPKE',
        'kar' => 'BTK',
        'szak' => 'Anglisztika'
    ],
    'erettsegi-eredmenyek' => [
        [
            'nev' => 'magyar nyelv és irodalom',
            'tipus' => 'közép',
            'eredmeny' => '20%'
        ],
        [
            'nev' => 'történelem',
            'tipus' => 'közép',
            'eredmeny' => '80%'
        ],
        [
            'nev' => 'matematika',
            'tipus' => 'emelt',
            'eredmeny' => '90%'
        ]
    ],
    'tobbletpontok' => [
        [
            'kategoria' => 'Nyelvvizsga',
            'tipus' => 'B2',
            'nyelv' => 'angol'
        ],
        [
            'kategoria' => 'Nyelvvizsga',
            'tipus' => 'C1',
            'nyelv' => 'angol'
        ],
        [
            'kategoria' => 'Nyelvvizsga',
            'tipus' => 'B2',
            'nyelv' => 'német'
        ],
        [
            'kategoria' => 'Nyelvvizsga',
            'tipus' => 'B2',
            'nyelv' => 'spanyol'
        ]
    ]
];
$my_exampleData3 = [
    'valasztott-szak' => [
        'egyetem' => 'PPKE',
        'kar' => 'BTK',
        'szak' => 'Anglisztika'
    ],
    'erettsegi-eredmenyek' => [
        [
            'nev' => 'magyar nyelv és irodalom',
            'tipus' => 'közép',
            'eredmeny' => '20%'
        ],
        [
            'nev' => 'történelem',
            'tipus' => 'közép',
            'eredmeny' => '80%'
        ],
        [
            'nev' => 'matematika',
            'tipus' => 'emelt',
            'eredmeny' => '90%'
        ],
        [
            'nev' => 'angol nyelv',
            'tipus' => 'emelt',
            'eredmeny' => '50%'
        ]
    ],
    'tobbletpontok' => [
        [
            'kategoria' => 'Nyelvvizsga',
            'tipus' => 'B2',
            'nyelv' => 'angol'
        ],
        [
            'kategoria' => 'Nyelvvizsga',
            'tipus' => 'C1',
            'nyelv' => 'angol'
        ],
        [
            'kategoria' => 'Nyelvvizsga',
            'tipus' => 'B2',
            'nyelv' => 'német'
        ],
        [
            'kategoria' => 'Nyelvvizsga',
            'tipus' => 'B2',
            'nyelv' => 'spanyol'
        ]
    ]
];