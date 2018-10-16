<?php
return [
    "CorpId"      => env('QY_WECHAT_CORP_ID', 'wwf82e897ad9dc4859'),
    "TxlSecret"   => "__PPxmJi1XEMlFjVSzD4wCG4hOwMccoxavX7czHRyEw",
    'AccessToken' => 'JOfm2MO5PuIy8ld0_q42MkvAdh4NKbYXowgul1Z9cpoTMKMGNvfwYqoUjSmlemOFkFZvKnEnaZFDkie9L-WVilz4ljbji5OC5II0Na5tdxhnH9BdsmAkzxzKNxg-ddggGZryXzMJrOkHDL9cgVqU_tUcG02O6m685blupbFxJfC-p7Mdaoxf7c1w6Ozz6TprUQJ0AHkXxw6ltV76661Gv_TW0hnVtugGiWVMvAQxoxvna5HUovujhpS76PI5jyxNybDuZBKenY2rQtdInfpU0YhmOL4W_1xl-LnfcoS8_Wg',
    "AppsConfig"  => [
        "resume"  => [
            "AppDesc"        => "人才库",
            "AgentId"        => env('QY_WECHAT_AGENT_ID', 1000013),
            "Secret"         => env('QY_WECHAT_SECRET', 'wuGY-WxG9OJnmI_w-n2LUha23ck6qIbjLeSVi_txRVo'),
            "Token"          => env('QY_WECHAT_RESUME_TOKEN', 'g9DoYE6kBnaBEXPRF79k2ua8jOw'),
            "EncodingAESKey" => env('QY_WECHAT_RESUME_KEY', 'K6YXmFTH19OKHuyR3y7o2lx5Wj5H0Jg29PJCDJgHlhs')
        ],
        "examine" => [
            "AppDesc"        => "审批",
            "AgentId"        => env('QY_WECHAT_EXAMINE_AGENTID', 3010040),
            "Secret"         => env('QY_WECHAT_EXAMINE_SECRET', '-lzF5vbdC1YP3tuBwdRdgo4MuCapwGfYTDPX-AwMN40'),
            "Token"          => "应用2回调模式的Token，在应用的回调模式里面设置",
            "EncodingAESKey" => "应用2回调模式的加密串，在应用的回调模式里面设置"

        ],
        "depart"  => [
            "AppDesc"        => "通讯录",
            "AgentId"        => '通讯录ID',
            "Secret"         => env('QY_WECHAT_DEPART_SECRET', '0cCg0OQuaURA1-ZDKwV0_7sv048tKT_E_d522knhBvY'),
            "Token"          => "应用2回调模式的Token，在应用的回调模式里面设置",
            "EncodingAESKey" => "应用2回调模式的加密串，在应用的回调模式里面设置"

        ],
    ]
];
