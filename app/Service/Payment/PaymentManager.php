<?php

namespace App\Service\Payment;

use App\Service\Payment\Methods\EwayPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentManager
{
    private $method;

    private $request;

    public function __construct(string $method, Request $request)
    {
        $this->method = $method;
        $this->request = $request;
    }

    public function status()
    {
        return $this->getCurrentMethod()->getStatus();
    }

    public function transactionId()
    {
        return $this->getCurrentMethod()->getTransactionId();
    }

    public function errors()
    {
        return $this->getCurrentMethod()->getErrors();
    }

    private function getCurrentMethod()
    {
       /* switch ($this->method){
            case 'eway':
                $gateway = new EwayPayment($this->request);
                break;
            default:
                $gateway = new EwayPayment($this->request);
        }*/
        $gateway = new EwayPayment($this->request);
        return $gateway->getPaymentMethod();
    }
}