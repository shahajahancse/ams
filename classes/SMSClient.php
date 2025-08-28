<?php

class SMSType
{
    //put your code here
    CONST Standard = 0,
        ASCII = 1,
        Octets = 2,
        Latin1 = 3,
        OctetUnspecified = 4,
        Cyrllic = 6,
        LatinHebrew = 7,
        UCS2 = 8,
        DefaultFlashSMS = 16,
        UnicodeFlashSMS = 24,
        Class0 = 240,
        Class1 = 241,
        Class2 = 242,
        Class3 = 243,
        Class0Alert8Bit = 244,
        Class1ME8Bit = 245,
        Class1SIM8Bit = 246,
        Class1TE8Bit = 247;
}

class SMSResponse
{
    public $StatusCode = '';
    public $StatusMessage = '';
    public $MessageID = '';
}

class SMSClient
{
    public $APIPublicKey = '';
    public $APIPrivateKey = '';
    public $APIEndPoint = '';

    /// <summary>
    /// Public constructor for building client object
    /// </summary>
    /// <param name="publicKey">Your API Public Key</param>
    /// <param name="privateKey">Your API Private Key</param>
    /// <param name="endPoint">The web service end point URL</param>
    public function __construct($publicKey, $privateKey, $endPoint)
    {
        $this->APIPublicKey = $publicKey;
        $this->APIPrivateKey = $privateKey;
        $this->APIEndPoint = $endPoint;
    }

    /// <summary>
    /// Send a single SMS
    /// </summary>
    /// <param name="sender">Sender ID / Brand name</param>
    /// <param name="receiver">Receiver mobile number</param>
    /// <param name="message">SMS message body</param>
    /// <param name="whenToSend">When the SMS will be sent, use UTC+0 time zone</param>
    /// <param name="type">Message type</param>
    /// <returns>Returns response as comma separated as: ID,Status Code,Status Message</returns>
    public function SendSMS($sender, $receiver, $message,
        $whenToSend, $type)
    {
        $delay = $whenToSend - date('Y-m-d H:i:s');
        $delay = $delay > 0 ? $delay : 0;

        $url = $this->APIEndPoint . "/HTTP.svc/SendSMS?publickey=" . urlencode ($this->APIPublicKey)
            . "&privatekey=" . urlencode ($this->APIPrivateKey) . "&sender="
            . urlencode ($sender) . "&receiver=" . urlencode ($receiver) . "&message="
            . urlencode ($message) . "&delay=" . urlencode ($delay) . "&type=" . urlencode ($type);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/x-www-form-urlencoded'
        ));
        $result = curl_exec($ch);
        curl_close($ch);

        $response = new SMSResponse();
        $resultParts = explode(',', $result);
        $response->StatusCode = $resultParts[0];
        $response->StatusMessage = $resultParts[1];
        if ($response->StatusCode === 6)
            $response->MessageID = $resultParts[2];

        return $response;
    }

    /// <summary>
    /// Gets balance information for current account
    /// </summary>
    /// <returns>Balance in decimal</returns>
    public function GetBalance()
    {
        $url = $this->APIEndPoint . "/HTTP.svc/GetBalance?publickey="
            . urlencode ($this->APIPublicKey) . "&privatekey=" . urlencode ($this->APIPrivateKey);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/x-www-form-urlencoded'
        ));
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    public function IsUnicodeText($smsText)
    {
        for ($i = 0; $i < strlen($smsText); $i++)
        {
            if ($smsText[$i] > 255) { return true; }
        }
        return false;
    }

    public function CalculateSMSUnit($smsText)
    {
        if (IsNullOrEmptyString($smsText))
            return 1;
        else
        {
            $smsType = SMSType.ASCII;
            if (IsUnicodeText($smsText))
                $smsType = SMSType.UCS2;

            $smsText = trim($smsText);

            //2 chars {}[]\|^~€
            $extra = 0;
            foreach ($smsText as $character)
            {
                if ($character == '{' || $character == '}' || $character == '[' || $character == ']' || $character == '\\' ||
                    $character == '|' || $character == '^' || $character == '~' || $character == '€')
                    $extra++;
            }

            $length = strlen($smsText);
            $unit = 1;

            if ($smsType == SMSType.ASCII || $smsType == SMSType.DefaultFlashSMS)
            {
                $length += $extra;

                if ($length > 160)
                    $unit = ($length / 153) + ($length % 153 == 0 ? 0 : 1);
                else
                    $unit = 1;
            }
            else if ($smsType == SMSType.UCS2 || $smsType == SMSType.Cyrllic || $smsType == SMSType.UnicodeFlashSMS)
            {
                if ($length > 70)
                    $unit = ($length / 67) + ($length % 67 == 0 ? 0 : 1);
                else
                    $unit = 1;
            }
            else
                $unit = ($length / 67) + ($length % 67 == 0 ? 0 : 1);

            return $unit;
        }
    }

    function IsNullOrEmptyString($text){
        return (!isset($text) || trim($text)==='');
    }
}