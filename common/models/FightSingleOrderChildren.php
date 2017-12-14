<?php
namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class FightSingleOrderChildren extends ActiveRecord
{
    const TYPE_PUBLIC = 0;

    const TYPE_CHIEF = 1;

    public $avatar = [
        'http://wx.qlogo.cn/mmopen/ajNVdqHZLLAANgIiblfkq26Az3OtZaDs4VBmX2qdxmC0icggiaTx8IrQgOCzwl70iaiapEF86VSZonsQiap3zIjib3xMw/0',
        'http://wx.qlogo.cn/mmopen/ajNVdqHZLLCabKTiab1eDwhCHS5PUasG3fsELcrcg7eYkpV2piaYicFggicVibUm1cTym3TL182ohibpVuCrxjAurNbw/0',
        'http://wx.qlogo.cn/mmopen/RrYBxicdWAudXsAMs0icv0sCy36DwNbS00wGsvC1ztZvic08GV6HYoJmjb8UnZgE3ic58ZAz3d94Wq51R07H0pZpUDumlpTThrcb/0',
        'http://wx.qlogo.cn/mmopen/ajNVdqHZLLCEQqCIDj2rhbnTxwMccM2EEpiags9ReqF5K14SWsU9qgsC9yQxT3tExSfZCYrwVKfvibFyicr990t3g/0',
        'http://wx.qlogo.cn/mmopen/RrYBxicdWAufeANm0lFxfmmFmDgE6FwPQojv4W5rQFsWKpBhEIw2P0vfvrCdQQQCtCjkeNBhLeKuRj6FgqhN50VHsHf2VJTYd/0',
        'http://wx.qlogo.cn/mmopen/NoFChqEQomGpZkfqwYWLd8DfCnzn7IGo8dNwicJWBLXBg1PY5PIxy1S4BzRPWRl1KqhtQOWQIm67qWhasuyqibfZXuTj9xbVOd/0',
        'http://wx.qlogo.cn/mmopen/2RiaMqYR2hZ080tBZNcs4lPGCokgMuq5viavO02eiae6h2NXkwJUB7pw23w6DESg3IbER2LRsFxT5e1V1UFdpicEYCvUJ64EGxcX/0',
        'http://wx.qlogo.cn/mmopen/PiajxSqBRaEJkewWGJEffSQ6wI2QBBkA81BtAxpaYL6Np4fL5FC07LwkZ0hZiaOpEbB7Aiajv61aKjoRjDEOusl9Q/0',
        'http://wx.qlogo.cn/mmopen/TibS084niamRuGeBck8ShQw5P7KfJmtljt16ONib2puLcSh2u79HyDE9NAnAzricXBDiaEjvsBlzX1DGAU4icRaRmWAUN142a8xm7j/0',
        'http://wx.qlogo.cn/mmopen/2RiaMqYR2hZ2JycI8X4NhOFQAeG7OQ9sx4icrkudrRwAjJmNGmZauibWV6IDGRGVhBeoAibBvknqQ2FTYnQgY410psPtEwN2HoiaS/0',
        'http://wx.qlogo.cn/mmopen/ky0yDnUU3WH4Fs96BErZDswcPfgHlCaqhDdYL607KNKK7SicpiasYEVdECqlVBhMfksVjoGLiaTwNqskez7WRYYZ6dRzWiaNicciaC/0',
        'http://wx.qlogo.cn/mmopen/RrYBxicdWAucSfKagNavgtChA5tFIq42ZuEw6vaXwJGTAHaIVmQcUNINHFiaRoLnMZCAYJukQP8JQaRN5uGaocMZNmibiabuk5gQ/0',
        'http://wx.qlogo.cn/mmopen/Y0Xv64qdianWY1LIXCGrZZ0zFacnBcwViaucBiaZmM0Qo815QIeAYCr71bz1a7f3iarulSgXWJlS2bOseDre2vvy2y69QuAWmjOic/0',
        'http://wx.qlogo.cn/mmopen/NoFChqEQomHnPOD3CjWqibbhLMHibYwkmk6dziaPDb6FjFbSa5Mn8Qia2WCFFeJwib049NV8F4PexkeTATlWn3Gp1u9C9zkiaxCcAF/0',
        'http://wx.qlogo.cn/mmopen/RrYBxicdWAucW0M400fdtH6j7tTswByicmKFJfpxHEFfEibEV0GRlTz6SmRCVDdZwqAR3w6CuD93dg3rBDTTR3ticKLgDrMZXRYd/0',
        'http://wx.qlogo.cn/mmopen/Q3auHgzwzM4rPYTf7NicZ6BylBA9F5BqWXBX9K8ePoLCibibgaKQBuRcIMV955FwSpODNnPn9mpUp9aibDHrC2MHpSF0xusI2m0YBd3bdSyLDxg/0',
        'http://wx.qlogo.cn/mmopen/RrYBxicdWAucJRpkSSY5sEXM4Nk1yuZ7dQWET1PeTWevSnfoQIrWNiaKU8oKl7ntoWvcrLopWImHaa0ial5oFibicgGYeBPxNOqFA/0',
        'http://wx.qlogo.cn/mmopen/RrYBxicdWAueC0mZA25ZicaROr9NibUOt1icG0vQ7nayP3iagJZxfg2jib5xMpncaHCiblrBRxIbccicf8ywvuxdAOxITQ/0',
        'http://wx.qlogo.cn/mmopen/PiajxSqBRaEIzMbJezkmOWsjeJ855XEQCCml2dtOIun81g5TQoLhLZLCfHd5tCcbxOdcic3wKuSzibOZxVkgImBSA/0',
        'http://wx.qlogo.cn/mmopen/RrYBxicdWAucJRpkSSY5sEaQmYREULPqjf2E0rCL12iap1ybC97FDiceVrAiamrmRLH5HPiaTZ0xnborzzobMy6QQRbRSQXy7WrVK/0',
        'http://wx.qlogo.cn/mmopen/sEXYLetLaIiaMI2BfMicqMxib59feWArczticxCUKqPzicZ5lEsnibzBLjq4UgxC2WF3xEL3pv9SibuMnD0gIbds03nHnqxuGokjrt9/0',
        'http://wx.qlogo.cn/mmopen/sEXYLetLaIiaaI029o2NwMFtV1dUIUfgiblr9BvYphpvPIEKpbbpJibOKKuevRibmoMtaRhCF4xDoibs1VZufxjqqv5cTU1ZicfCIR/0',
        'http://wx.qlogo.cn/mmopen/sEXYLetLaIjNsyhKPs6vYZBEeGca23zR6JN5tV8JT0KV1VicP2RI2J4NbvPBqj3FcgCUjYWKcU2zC7CKlfXDcicSPAUcms1Cb3/0',
        'http://wx.qlogo.cn/mmopen/RrYBxicdWAuc9h3qAj2JvQdHRaXWK4Gcw5RIWTAtNqy9ulQ2IaAWJJ2NPuhV1rQ3q9ROy3hD8TKNTVjBsiamdWbiajxm7iagYB2ia/0',
        'http://wx.qlogo.cn/mmopen/2RiaMqYR2hZ080tBZNcs4lDGicl88UqqWnydWSyyV3G92zGmq0UqProBLgzNejyj0QIlx8r8GV2Zj0biaaJtKzFrv2efmBj3y5q/0',
        'http://wx.qlogo.cn/mmopen/NoFChqEQomGpZkfqwYWLd8nMibbduzN1Xe9c14DAibTWVWNiajbMwBbh5yY19I2m0SlGcLbAgib9ffibNbQpjDt6vlFYic7E5hr4rE/0',
        'http://wx.qlogo.cn/mmopen/XExgjql2ox8dYdStKqzCMIpkt7XDUaRDA0FlnFCNHExZVfevrrDSVqxCIdibdZkf9DVdtAKqv3J8NIiaugHOppPU2MjzKhlxaK/0',
        'http://wx.qlogo.cn/mmopen/VLSu0xR7GCupyibFRNianS1O7vx8fzKoKJCzJKf8QYr1ndQNZaz5ibdC1777QNGfaDOc20fmRiaNNoVdsfUgDC4siblO4ibzj0WmXl/0',
        'http://wx.qlogo.cn/mmopen/NoFChqEQomHibUjWVVUJr077TyJRVaiaQ3WC1APnEMRPdZ6uibHXycUUXBIrpQJE1r7XHjKqNBsb2froZMoJbukyQ/0',
        'http://wx.qlogo.cn/mmopen/PiajxSqBRaEIoTFjKes0syiawUbygiaC2C2WABst1OUPFzDID2ibEicsr883Ga6Bx6BNnmaW6IVYfibH8I3mu4rtfLOg/0',
        'http://wx.qlogo.cn/mmopen/RrYBxicdWAucJRpkSSY5sEa3EXpzsKutUmnPpmAeFemAexKNxz6ibBsPKIaI1Z1lScuTI6dSnDTG3pic3mEAv5VQAiaafHaicUR9o/0',
        'http://wx.qlogo.cn/mmopen/Q3auHgzwzM6qBBBiaax0PFQxD97XpeSviaSbBhtb4t1BExnzBKibdFtPUrzhcSbfWdUB4PSbSCwdXgDXIjkgTybB2b24RnZrMFic1eXiaj92VWw0/0',
        'http://wx.qlogo.cn/mmopen/Q3auHgzwzM4BoSdmodyRxOTk3XwvkPc601ebicP5PyGibiaSeQmrgTPmfaUNibwWablUcUSVHR5K9GMlMzzFubSZTQ/0',
        'http://wx.qlogo.cn/mmopen/RrYBxicdWAucQVhiaC5xHyiaX6Lgd2uXsB5nQnt0AQiajWeMJRs2kLZOaVZt84jzrtJtIxPyjkVRrZgkmnibwduSyojChYu21MbPic/0',
        'http://wx.qlogo.cn/mmopen/sEXYLetLaIj3983zguWHWSKRcfXW042tpUEhUYqskACgRagOic5zzAQWxGUKiaKn714j7yhDyiaGC1Yiana27MZFUp7lHLXSBK9r/0',
        'http://wx.qlogo.cn/mmopen/Q3auHgzwzM5gxmIP6HSAs7ibsrdpm6rbT1hRrCrMZxbtntVvLvgy5sq5xogNIUSsPQgdqMvtaJlxibdl7wFuic5FIJEMVQOyJknNFW9VVLVvKQ/0',
        'http://wx.qlogo.cn/mmopen/RrYBxicdWAucSfKagNavgtH0wh02zPRxlLhxjV8IE2D3FYaPTB3Dv8PZSKu0DDS8F0ziaK7Zwo4rLgIXLiaqVHhIWDzqiarkpN71/0',
        'http://wx.qlogo.cn/mmopen/sEXYLetLaIjNsyhKPs6vYW1olL5rwObDSWTFIRkqU6nCFXbGmUAoTzn0w5WESZ43NVyled55tbm0lcK9e3QdVLbgUmpmw8SI/0',
        'http://wx.qlogo.cn/mmopen/RrYBxicdWAucSfKagNavgtNkiapHTyibiczuciannw40pGlNWVxposttOcd4FuNF6lY0Wia5Y1xO0vHicoiaNCZpbrNVllD8tZ5FaYXE/0',
        'http://wx.qlogo.cn/mmopen/RrYBxicdWAucSfKagNavgtP1HfCAw9xGM11oWiaRwFZHmev5bUI4GVk6nJ6FhJe4Lvk1lHrKF1icnKkOYtmhNhHziaibRU1j2j8fr/0',
        'http://wx.qlogo.cn/mmopen/Y0Xv64qdianWY1LIXCGrZZ3UCSX2fQ3vX8UUSnTHFKWia60ibGo9WfE28PQUia1WjaEvvicm8zlaLenzguibebauoyTRUeUhTREvsR/0',
        'http://wx.qlogo.cn/mmopen/RrYBxicdWAucSfKagNavgtB3T54bmBp5YLV2lHpZq7BUibzAC6YLnqfL5o1kvmb8AOgHEOktxZ7ucLxJiaCrNicxhbarxovibzMZj/0',
        'http://wx.qlogo.cn/mmopen/sEXYLetLaIjNsyhKPs6vYfM5YZoUicgYRECsCAzDovNrRWEhJcF3gAlXa9FGUpQWuv6RNnIehpwKJSIwCFo28MFfbiby78IXIO/0',
        'http://wx.qlogo.cn/mmopen/sEXYLetLaIj4n29kaXjicdO4cytpqF7833oXJHSiciaEMwov3kKyM7g59FNic3ic748DNibWo2D2xticEtv3mOBG6TKVkQks0PsiatpP/0',
        'http://wx.qlogo.cn/mmopen/sEXYLetLaIjttcDL084rHwvViaLd9eTQHibZ8CgBjPGRhGzgfXiaaut6pn94iaGlQ2ltibbOm8SL78SeVvxeI7wVDTuQeSm1JLn2h/0',
        'http://wx.qlogo.cn/mmopen/XExgjql2ox9kDCg8Q2o3uqO9cktWGyOKAWreCm2y2BPDZraCWI6Edic3vwJqoOGJV841bA5LH0oQTiaR9ys6wMp9OvRt5icuE1L/0',
        'http://wx.qlogo.cn/mmopen/ajNVdqHZLLDh514Mn8Okm7stslQC9GGdrqiaDQJOPJ38M68ia79ELPGZg2YSna9S1DKvg6Vr0CEoWgzm2ndibTNEw/0',
        'http://wx.qlogo.cn/mmopen/Q3auHgzwzM4gLqgelAuyeSpSAgCDWgwEscjoEbGSZMt8QAFxe6HASZjzk90N6xM0qTuSZvdEKct3AYEib6Xern1kOLZsfWBBP7Cy9sq40H9s/0',
        'http://wx.qlogo.cn/mmopen/RrYBxicdWAudEKfdYkSRxictDl0hqqU6yYXyq95rfqMpxzmyROV6Euxc8pzRZXcr6JGH4picM3icj4cHBfur3A3tic1e1sDBWwH70/0',
        'http://wx.qlogo.cn/mmopen/JqQa6R3kIDIMIsvy0wHOkMFt0Oct6aia42M5WMFpOPw4TMv9dDKQyrujhCmEyKXYCDcOMoD3zrNCJwfYKJ2beWfUUjZicsQ3bE/0',
    ];

    public static function tableName()
    {
        return 'fight_single_order_children';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at']
                ],
            ],
        ];
    }

    public function rules()
    {
        return [
            [['username', 'tel', 'is_chief', 'pid'], 'required'],
            [['username'], 'string'],
            [['tel', 'is_chief', 'pid', 'created_at'], 'integer']
        ];
    }

    public function saveChildren($good_id, $username, $tel, $pid = null)
    {
        if ($pid == null) {
            $fightSingleOrder = new FightSingleOrder();
            $fightSingleOrder->good_id = $good_id;
            if (!$fightSingleOrder->save()) {
                return false;
            }

            $pid = $fightSingleOrder->id;
            $this->is_chief = self::TYPE_CHIEF;
        } else {
            $this->is_chief = self::TYPE_PUBLIC;
        }

        $this->username = $username;
        $this->tel = $tel;
        $this->pid = $pid;

        return $this->save();
    }

    public function getAvatar()
    {
        $length = count($this->avatar);

        return $this->avatar[$this->id % $length];
    }
}