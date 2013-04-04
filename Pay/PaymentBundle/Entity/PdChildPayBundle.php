<?php

namespace Pay\PaymentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Itc\DocumentsBundle\Entity\Pd\Pd;
/** 
 * 
 * @ORM\DiscriminatorMap
 * (
 *  {
 *      "pdPayment"    = "Pay\PaymentBundle\Entity\PdPayment\PdPayment"
 *  }
 * )
 */
class PdChildPayBundle extends Pd {
    //put your code here
    public function createTransaction()
    {
        return;
    }
}

?>
