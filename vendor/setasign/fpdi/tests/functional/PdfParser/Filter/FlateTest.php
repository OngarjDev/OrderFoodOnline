<?php

namespace setasign\Fpdi\functional\PdfParser\Filter;

use PHPUnit\Framework\TestCase;
use setasign\Fpdi\PdfParser\Filter\Flate;
use setasign\Fpdi\PdfParser\Filter\FlateException;

class FlateTest extends TestCase
{
    public function decodeProvider()
    {
        return array(
            ["\x78\x9c\xF3\x48\xCC\xC9\xC9\x57\x08\x4F\xCD\x29\x01\x00\x13\xA8\x03\xAD", 'Hallo Welt'],
            ["\x78\x3F\xF3\x48\xCC\xC9\xC9\x57\x08\x4F\xCD\x29\x01\x00", 'Hallo Welt'],
            // This is the compressed-crossreference with an invalid checksum
            [
                "\x78\x9c\x62\x64\x60\xd9\xf1\x8b\x81\x81\x91\x81\x65\xe7\x2a\x30\xb5\x6b\x07\x98\xda\x7d\x1e\x4c\xed\x55\x03\x53\xfb\x6a\x19\x18\x00\x00\x00\x00\xff\xff",
                "\x01\x00\x04\xb8\xfa\x00\x00\x01\x00\x04\xb9\xaa\x00\x00\x01\x00\x04\xba\xb8\x00\x00\x01\x00\x04\xbb\xcf\x00\x00\x01\x00\x04\xbd\x26\x00\x00\x01\x00\x04\xbe\x7d\x00\x00"
            ],
            [
                hex2bin('789c626460174b6060606460177f0ca624de8329292630252d09a6644cc1946c049892eb04530a86604ab10e4c29298129e55c30a5b2034ca9898029f524060600000000ffff'),
                hex2bin('0100071660000001000717e3000001000718ef00000100071a0200000100071b1900000100071c3500000100071d5800000100071e89000001000720310000010007217e000001000722220000010007236d000001000724b800000100072614000001000727620000')
            ],
            [
                hex2bin('789c24cf394b02700040f1bf43383a358448383be9d2281e691a791f85b77984468a592adea20dcdd1a2207e02411071567010829c83b6a0cd555c84e7f41b1f4f22a4da85101221d59940ef0343148c45b8ec80e913cc23b89a826505d61fb8dec18d0c6c0ab0ebc0e10067005cafe03e163cefe01d826f06fe35dc6ee06e0b815308aa21e48570102219882a212687780aee27901490b2437a000fff90b9806c0f1ebfe1e91c7259c8cfa17002cfc7a3621f5efea0a48172132a5f503d835a02ea6368eca16586f607747ea1ab825e09de96421c000000ffff'),
                hex2bin('0100073fc3000001000741460000010007425600000100074360000001000744740000010007458200000100074696000001000747a1000001000748b5000001000749c700000100074adc00000100074bf900000100074d0f00000100074e1d00000100074f41000001000750500000010007515b00000100075276000001000753740000010007548a0000010007559f000001000756b7000001000757cb000001000758d2000001000759f000000100075b1500000100075c3100000100075d5500000100075e5c00000100075f6a000001000760210000010007611b00000100076266000001000763b2000001000765000000010007664f0000010007679c000001000768e900000100076a3700000100076b8500000100076cd100000100076e1f00000100076f6b000001000770b900000100077205000001000773500000010007749b000001000775e6000001000777320000010007787f000001000779ce00000100077b1900000100077c6400000100077daf00000100077efb0000010007804700000100078194000001000782df0000010007842b00000100078577000001000786c40000')
            ],
            [
                hex2bin('789c6264607be0ccc0c0c8c0f6f038987af41e4c3d6107534f95c1d4334330f5dc1d4cbd4804532fa783a95797c0d4eba760eacd7730f58e194cbd6701531f92c0d4c75d60eab31098fa9205a6be1e0253df25c1d48f4230f5f30498fa2d0fa6fe9481a9bf67191800000000ffff'),
                hex2bin('010006e0430000010006e1c70000010006e2ef0000010006e4070000010006e5230000010006e6310000010006e7470000010006e8610000010006e9970000010006ead20000010006ebe50000010006ecf70000010006ee030000010006ef040000010006f0620000010006f1ba0000010006f3120000010006f46a0000010006f5c20000010006f7190000010006f8710000010006f9c80000010006fb1f0000010006fc760000010006fdcd0000')
            ],
            [
                hex2bin('58857595cd6edb301084ef05fa0e3cb6e84111c9251dc030102408e0437f50370f4049942b2096045a3ef8ed2b698cd89a26bc18fa44d2b3331457298cec71fbb46d9b4165bf5257eee2a0eaa6ad523c76a7544655c47dd37efe7499ac72adaaa61c18cf8fe521f45734edbb3b1f8778d8b67577e5ebb5ca7e8fd38f433aab2f0fd378fcf6909af0fad2366557c5af2afb99aa989a76ffd1fbdda9ef5fe321b683ba539b8daa627dfbc7df43ff231ca2cade59fdcedc3fe73e2abd7c915f4a1a571cfb50c614da7dbc29e26e1c1bb57e1ec7e68a635b7db4c25d762ceaf26f48ffef34ff2cb199b1662cc09a7001bc225c02df13ae81cb25cea144578473e04818020d09cc2d704ed8011bc22b60217c0fec0807604f18c51b2a3eaf80c3126b28b1a4447b604b18022d09d4106849a086124b4a3462b01483460c96623088c1520c4603d7841183500c063108c560707c848e8f8127429e187822e48941f142c51ba423948e8512474a2c94385262a1c491120b258e9458a4e3281d0b818e045a08742c10a1390acd223447a1599c2a47a7ca224b47590ab27494a5e09372f44909227614b120624f110b8cf564acc0584fc60a8cf564acc0584fc60a8cf564acc0584fc60a8cf564acc0584fc6ae303b50f1abc96f9df3cd564c56e9e9b65962034c7e171698fc2e1cf06d96e36dcdb7f174812fbad85b2f294f298dfd666e7e73d798fa45d3c6b746d977fd621f7af807a772b731'),
                hex2bin('20202020202020202f434944496e6974202f50726f635365742066696e647265736f7572636520626567696e0d0a20202020202020203132206469637420626567696e0d0a2020202020202020626567696e636d61700d0a20202020202020202f43494453797374656d496e666f0d0a20202020202020203c3c202f526567697374727920284141414141432b417269616c556e69636f646529202f4f72646572696e6720284141414141432b417269616c556e69636f646529202f537570706c656d656e742030203e3e206465660d0a20202020202020202f434d61704e616d65202f4141414141432b417269616c556e69636f6465206465660d0a20202020202020202f434d6170547970652032206465660d0a20202020202020203120626567696e636f6465737061636572616e67650d0a20202020202020203c303030303e203c464646463e0d0a2020202020202020656e64636f6465737061636572616e67650d0a2020202020202020363120626567696e6266636861720d0a20202020202020203c303030303e203c303030303e0d0a20202020202020203c303030333e203c303032303e0d0a20202020202020203c303030353e203c303032323e0d0a20202020202020203c303030623e203c303032383e0d0a20202020202020203c303030633e203c303032393e0d0a20202020202020203c303030663e203c303032633e0d0a20202020202020203c303031303e203c303032643e0d0a20202020202020203c303031313e203c303032653e0d0a20202020202020203c303031333e203c303033303e0d0a20202020202020203c303031343e203c303033313e0d0a20202020202020203c303031363e203c303033333e0d0a20202020202020203c303031383e203c303033353e0d0a20202020202020203c303031393e203c303033363e0d0a20202020202020203c303031613e203c303033373e0d0a20202020202020203c303031623e203c303033383e0d0a20202020202020203c303031643e203c303033613e0d0a20202020202020203c303032363e203c303034333e0d0a20202020202020203c303032373e203c303034343e0d0a20202020202020203c303032383e203c303034353e0d0a20202020202020203c303032393e203c303034363e0d0a20202020202020203c303032623e203c303034383e0d0a20202020202020203c303032633e203c303034393e0d0a20202020202020203c303032663e203c303034633e0d0a20202020202020203c303033303e203c303034643e0d0a20202020202020203c303033323e203c303034663e0d0a20202020202020203c303033333e203c303035303e0d0a20202020202020203c303033343e203c303035313e0d0a20202020202020203c303033353e203c303035323e0d0a20202020202020203c303033363e203c303035333e0d0a20202020202020203c303033373e203c303035343e0d0a20202020202020203c303033393e203c303035363e0d0a20202020202020203c303033613e203c303035373e0d0a20202020202020203c303034343e203c303036313e0d0a20202020202020203c303034353e203c303036323e0d0a20202020202020203c303034363e203c303036333e0d0a20202020202020203c303034373e203c303036343e0d0a20202020202020203c303034383e203c303036353e0d0a20202020202020203c303034393e203c303036363e0d0a20202020202020203c303034613e203c303036373e0d0a20202020202020203c303034623e203c303036383e0d0a20202020202020203c303034633e203c303036393e0d0a20202020202020203c303034643e203c303036613e0d0a20202020202020203c303034663e203c303036633e0d0a20202020202020203c303035303e203c303036643e0d0a20202020202020203c303035313e203c303036653e0d0a20202020202020203c303035323e203c303036663e0d0a20202020202020203c303035333e203c303037303e0d0a20202020202020203c303035343e203c303037313e0d0a20202020202020203c303035353e203c303037323e0d0a20202020202020203c303035363e203c303037333e0d0a20202020202020203c303035373e203c303037343e0d0a20202020202020203c303035383e203c303037353e0d0a20202020202020203c303035393e203c303037363e0d0a20202020202020203c303035613e203c303037373e0d0a20202020202020203c303035623e203c303037383e0d0a20202020202020203c303038613e203c303061653e0d0a20202020202020203c303038633e203c323132323e0d0a20202020202020203c303062313e203c323031333e0d0a20202020202020203c303062333e203c323031633e0d0a20202020202020203c303062343e203c323031643e0d0a20202020202020203c303062363e203c323031393e0d0a2020202020202020656e646266636861720d0a2020202020202020656e64636d61700d0a2020202020202020434d61704e616d652063757272656e7464696374202f434d617020646566696e657265736f7572636520706f700d0a2020202020202020656e640d0a2020202020202020656e640d0a')
            ],
            [
                hex2bin('789cedbd07601c499625262f6dca7b7f4af54ad7e074a10880601324d8904010ecc188cde692ec1d69472329ab2a81ca6556655d661640cced9dbcf7de7befbdf7de7befbdf7ba3b9d4e27f7dfff3f5c6664016cf6ce4adac99e2180aac81f3f7e7c1f3f229ebcf98d937be99bfa374e76d31dfa0fff1edcdb49df2c7ee3e4eed3e2327dfcf8ee1727674fd3ddfda3a3df3879f2f4e4374e0ef6c63b07e9f6bd9df183bdf4cd8c1a3edbd94b1fa46fce09ca0e41fbc16f9c6cbdbc93bef9e9df38d91fdfff9440a2d5c35dfe6667bc979affd717d472575ade1b9b86bb7bd2726bc7c038e882d8bd878760eceeefee3ef8d4fd320071f740206e9b6f76f7f4ab83fbf28d7de79e7be97e1ce1fbbda1edee3cbc15627640f74cf70f1fc4fbd84ba5e9e91727dd89b86f27e2fe78673fdddefb74bcfba99987dd74778727e2e076a4aaa59bbdf1a7fb21465bb97c737fbc67a86fe7766abedab12fe937f3de37bb3b4ae0f607f2dd83f14333f85d629bb0affbeeab1df9aa3008eeba79f95421f627f361f0d2aeebca2078a174b5af7caac0ec2bfb764cca330bf3cabe878341ef27e5bb4fc7fb8e4a3aa82a32a87df94aa9ee339b792bebbd65505ff7a9ae183606c3ddf10303d090e2ffe8ca90ed6912c14f8961e7c382dbdddd55d4b5af870e7783e02c32f90ad08eca027c28a4e831be3716cb780f05e39b78f989cec54df2abc87c3adeebe279530f760aec30b6567d52e92cf7faedcfba95fecddd5a4ef24451097b31d8fdfb319905b890af0e3c85d09583fb4ee036488faa91651ff77bca2fe706c10e3962e3b5ecd77dc74aa245dc0a694c770c73b8e9bc6e1d07f6c97325df3de80f34a62f0767c2bc6445a63fb3111934d367696af1fbd4484887e5467d6955c5704b56f76cefe0846ecdac527522b5412998b9d4110e33ae6533abf2eff6bf3244b11d59a20c5b03677836606e45eb46cc37f0ba7634a4833c6c23b37ad31cf5dfd8601b75583d4c0c09b6f7771eb03fb12b4e9d11ac9b90e85bc0219f2626214645dfe0a5e8703c95fd5007da67964d02a95f29b8bdf141cf2ac65c9161853acc97c3ccb7b5548a7b3a76588f5aa7abe9b3a31d8e02b422ae082b7f048eea060b70205f59efced2cd8c65aefd042e9ce2706c66e861572aac9fe1ecb9f6a443f27c93ddae87e9bc2085663d4c6f568551b74a33ab9ebad7e15ac3ed0d7790aeea9a5857c41bee2d5c9d98de1e7208b483889f75934428b91f8c0d66c3de46971837818ef885037a6f9382fd3a9266a8eb04a427051a440484df30c746728d8020620d7157a731e6ea1a3fb1c381b69fbe77d2796383abbdc164dc04cc4a403f58eafb405619f6754e4441dec262466c8e511c766e9ca00f93cca0bc41682336b26fe487bd899b9da57b07fbf776891cbd5f580ec696699cd1b99d043d352f7a41a10eb7ef927667e8a167c974083178aa6dacabec691b9d8eb711a26f109541ff7f83af1ce3de9b1c1037ad9e5ff53522fa0d24b0f6cfb9369f928d319ecd26257e0b2fa0af4b0c39ecc89c6b1ce3fc61c3a370ace779bba8c084531aeafb5a7383cad0b44cccb51a74a0cc6c3805eda975a58f75042c7962f18fe26c15e36dece8065e1866a00d53da1dcd436b2adf27fab1dcd40fb5367158cc01d34158a2b82cc30662444cdbb0fb37685b76e4f3be01f91a31cf0615a098953a85fb48249bb7065d3f331ee37efa1a72431c2d43eaf945831af826adee14b47d51e7f2e5003563b64d69f39ff526f4e620d2c3e056b9b781d033e2771d0810e3f07acaffb64e639f9d37d9fe0d218d0ed5aa4067fb633a59a9e9545f0ff1a8ee53d971baaf9fbd7d1f7561f8a09b80dc90fddce04b2a716ca6a96ff1224640a5f4e62840e7faa6f954e7c1538037e46b9dd571619d1776eedcaad7be6c6e70e3ba8a97ad3c75b92da9637fca543afa49f05b0887c2b8311713895964d09bd608623c3d6c98372514951816e06d9cab4da198e9c98c2bb6b61021eb707a7538a8dee03a982ccfeb3e2d8c9cbce9bfa4a37a15a1bbc9569851ed380b34ecf6445218b748244714f99eceadcd7cf7e62fe21c1b362ad59cf8ab87073709652fec7e7f451e89166e4ce0f430b2b161d73edc844fcc7c0c6b76e3aca879bdc5949879b406d473ac95f01bb452df4c7d503cbab3fbf0d35d84a19d5f827834b224fca95d12dede7b20abc2f7ee1b2548abc2b4aebf23abc20f3b448f13ddac3ed3926727f4b536ae97ee8de65b070da08d525595f99ee08e5250a5ae47c1888e1e9e29b3f26fb5df4137ccb11ce621a718e85c99cfcd74f730b28e8ca7c61544f79541f6880fdaacdfdabf95e9eddfd614d871bd870b43a6f23ef4f0f6ee01d4a772cbaee196ad67912955e08ad7e608d9f1c806377570eeac4d8b98d6e1acf34dabe57d656938d029b14fb5e566d564b5f8ad961e86cdfaa61cc7b03bdcd7ca11d562405ff43dfb9b43a74d8a6f4310d123e7cd99f128cb684fc6f477a75ee978bbccf22623ba212b768b2c6d47be6f616986a3016bd0fa2fd9c0bc377f31e9d001d910a2478698a29401dd2282b89de18ee4430c8bf4828b5ba8acbe70bc57c06c515031fcbc4f9a9bd7ddfb69fc881adce4966cc81d4654867dab3703aae36c4f9eb3afef6852f43643e8d37c938fd2e18e0d4ec903e794dca3f575d2d0dbf73e3566e66b67d26fe60733e9feb29d329ec913f8c147776e2272f95e2a72c38acb8132df699f4336467d37abb53e1a91e4d3a68ccc8d51b6b320ae8b98357f0f5ddf99d1c84adc70b23466fe8657d962f6587bb53af2d39b39cc909b82c6073bf70f0e20073b0ff6efef107fb9cf98712376e6eb243f949ad6fcf749f33e466bc35c6e58601df6a8cc4b432e55240b7113112239631d8ecd98de866bc9af0d443710a74199b90dbd6362bd81816f362a1bccc5ff1a0acaa6f4cf064dd5413c9650b442b07f2b2a0da261134311156c782fc21a3adca188f95636ebebf985ef61e946d63e74e5e9464f28223883d4ed9b0fa76fed4a677f76fb34dab490d6591ff5a7e916118c720be5ce7a685821dde40e45e5754392f2c60541370eabc42d536984e81cbd4dea4ce19dabf2f6a75ae9622d517f0a6e9f0b52faf758ccad57ef3fe4248e2e58eb386f992afb3a8b967e1ed450f5db8af4ad54e7a6486970416398d936787907f24d2fccec0a4e24ee50dbd67f27e21199a933de8ac75b2632fdbdc259dd141bdf1caabc974c98e9b32fdd4ab37432f05e727890404653acfb44b5c2d77de76b1a3de380d848f7163ee5305ddf33a7eaa9875d7df186c044e9ebd0ecf39fcb34eaa8bbeb83c64951a512489a8ed972e66da2d16fdadd3532e09c59076f90cd36e9c3e1510dcfa4f5567d1df5a902b2487b8ecb86c565e322d830dca60ded802cfbd9016d22d0b0841e045844a4c35a126f66077188a0ee32081b72abb78fc63cdf6fd3fad9865054473cedcde086f4d626b33f388f7d15710b1e6e4d607d336d0c34e5fa2000d497acecd997de0f8ec16ac8e58d05054adf7ec27fd88add2206f45263832e4ed7cf62ff84be35fec9260e1c8ce0fbe6c8499cea451b50795cf635c2de0d6b7c319ba2748e48eee058de477263c6dae4a5fcf7ba0e4897ab342feecbf42669ba31748c79b6832278b37abb8db76ee5e140c7fafb6ec9577b2eb8deb4d4a35d991502cf7c1a9ff38df9ca69cb61e56628de0b192cf57edf3b3df27df3e1a25d74bb4d9acfd968f3d52d74e22d4c50247bd85b8db373f440e575d770433796b8c90d33c4f2e7e976f9a297fdb91f1ec24609d6e159f3e578bd17917733637dbdb721096c5c176b159cdd5570595f231a79b3cb169ebfb361328785de4c66bfabad07bdd1dcc4e356166e3767ca266e3d63774fa76cdfcc66dfe3b058f532d33b7d1a6f4ab40fbb871bbcb99b75e4651fde2db8ed3af2d6b0cf664d428f803ad3bd19daeecdbc95c8cd7314f37d867d3ff54d86bb77becaed74e0f361ba44f8dc687b2bbb16b3fba6bbdbe99f686e7b33a6fd7cb951bc26668eac43f5cde6f0103678cf3b2a3611b330accecceaebed78ee3611f6c1febddd7d50b4f3cb4d0b84076e8170ff3e73daf6bdfdf1fd4fdf874fadb1bcc5b2e92d1234b772a137f893664a6eb342d49bb49bc61a9b6665a848d0a50c60d966836d7279a0c1d5f141a29a7ed4838d48502c828b78941dac22fcf2d0f1cbc10e94fd3671cd3d6197bbcf88f2bb04eadcb9784f05d2f0e2b173966c2a46d5b8e74f1c6c1032e5033b9a5e10615ff2fc59edc9acd07b3d2976c64176a1d903a57e5f2bf7e4d36345c5ee5ce7cc8ff08da7119934259e1d533f02b5f6d16af5dd9d2e7b0c07a71e82da555fe7b9a8bdcb6eb6278567bd9648cf3d1fc7f2f981f66c5ff20225856fa6e7e661ec856e83effd2aebc43cd10d9999615a0ebbe086e17ea23fd71b26e0e6446d840d8c576902daeddd077bd0da940d406ce6231a0b65747445a9b211c4cac3d9021d9f25a51b792fef6a2773931b3828bac3bc770ba9b15e60cfb2c45c47c5c13a811687e88c2805942d3c36fb59f3fe3cfdb8c9f9dbbda1f78e0cdddaf7eb7363842f8c9f336836f6769cd9207b41c2b47d8f4d025e27b3b197de7bc866e353338efd9d07e4c01056fb0fe123d22f077b64c3d557bcfb1ded6a6fdfcf1d98770ff6eeddc7bbf73f0514bc4b2068aa8424faeaee7d27d482c22ea360ccd04d387caa604cf7f79593a6e3e9a5f165f70d89b883bd07dac143a56469d8db4df2a73bdaf93dea1413c993729f7e79f010a391be7fdfdfd70a9a65abbd7b02f626bccdf823b3b4eb6669f7215136ddde3b30be208d603755e3ae327d1313bd908e7aaa2e163d7c48d8379c2ee8fbeb5b26b0f754d4a0c735dcb75b58d9e8a41a35369462ee2f1f6d8827ec82a3d1f90f3e1d73fe17091b6e30988bdbb0c66a2665d59b14f392fda6ff921ae8a8e5b4a68978e81e8515bbf7b0dec58075f406cf2e556c87962ad1b58ec1d9ef78981f9c758bcdc581348e0491c39cdcf11c7c23a9447bf97ea47e1f8c3749cbb04bb369392112c10d2f27986e39b6bc71689bd6d6bf4eeee81659382b1a5e573ac9fdc0ce2d28183a3bb7f666e67b9ff15a461bd6da7b9ed6becf330e1bab4ea0ced5ef256ff744cda2e244ad2f7dc343da906235886b6ec649c85022d32429bc5051b1bfc9ce740677cb7c93e9afefc8dcd4df06dfd34ea085e952341bb17964b4e5a73b70e0b777617e3de2df84d35786785e0e5ed9ad1f966ee0d1dbab2f2f94b3f1f49b0816373aadc3a9d488b89accbd45dd25e16ff6212cb7df2251b5a1a3af6544fa2192f53e1f280e677df95221d26fbc88cbbce3566d1eda9e74a2ac203bc328d8f545af87ad0b286e250a9668b7637627ea76a9e9966cae2e4324cbd3279155d21a7afa24527eb50b90168fe10548ab563ac47333f0be7aeba4f7e290c3b8c11eeee9502cd73bcba66cda4fb0585eecc943d7dcf85eb2e210f3080662df8f7b0c6dd4c14da419ce0e47bc6c2541affb3e4936281623d5b7c6cc09fdf0143c50725a25f2e94d337da008bafce36d2660886d3afe98172d1a13a084f01c980dbec186306293ef756b7fd1f788153f9d6ecfc1deb0a2373c11dfb057e698a5c372c326e126be8ae527bf0ee1bec6f2c1a6d4ceb0d499976c24dc37ecbdb07783efae926213562ee1aaf3a3b151ccb788b0c2b0ef1e75e70759de79fa7d9ba598f5936e7d9bec5464840b3c2ef8c95e274e630eb19ac5f526e0566cfbd98608f70dad27f753e2b7b4ddda7d7fc1b5d7855dcf8d78d11b173a8d2da6b54c09842839b2277ef4d7b7c986396c32e946463756746164d0f3aff50d1ba077931646f11fd86f36195ea321fa0afebe318ab75d04ddb59ae2b661503f1030e1e61766e09ed33c28ab6e603712d610c9a2dc57e37dfb7c73f8ba41bbc51668753e0e7af361b9b4c3cf1117f1c1ae36dd4ce35d79d15fe633a4791092c61240f3d2113b762f3296ff17588be1991bceb2e97adf4d81865a136f9de6966ac0189b9bc7bc21af668c508f1f6216e876de67240b683dafe10cd13d9b21dadb6765b47d8f14a3bffc222b137671a883ef3dc303ce5b36aed65df9cae931c30386d9189dd337bf71f2ff00'),
                hex2bin('42540d0a332054720d0a3120302030203120302038333020546d0d0a2f446976203c3c2f4d4349442031343e3e0d0a4244430d0a38322e3038202d33302e')
            ],
            // can only be decoded with "window" size of 31 in the fallback logic
            [
                file_get_contents(__DIR__ . '/_files/Flate/special.bin'),
                file_get_contents(__DIR__ . '/_files/Flate/special-decoded.bin'),
            ]
        );
    }

    /**
     * @dataProvider decodeProvider
     */
    public function testDecode($in, $expected)
    {
        $filter = new Flate();

        $decoded = $filter->decode($in);

        $this->assertStringStartsWith($expected, $decoded);
    }

    public function testEmptyString()
    {
        $filter = new Flate();
        $this->assertSame('', $filter->decode(''));
    }

    /**
     * @covers \setasign\Fpdi\PdfParser\Filter\Flate::decode
     */
    public function testDecodeWithoutZlib()
    {
        $mock = $this->getMockBuilder(Flate::class)
            ->setMethods(['extensionLoaded'])
            ->getMock();

        $mock->expects($this->once())
            ->method('extensionLoaded')
            ->will($this->returnValue(false));

        $this->expectException(FlateException::class);
        $this->expectExceptionCode(FlateException::NO_ZLIB);
        $mock->decode("\x78\x9c\xF3\x48\xCC\xC9\xC9\x57\x08\x4F\xCD\x29\x01\x00\x13\xA8\x03\xAD");
    }
}
