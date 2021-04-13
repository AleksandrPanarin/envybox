<?php


namespace App\Services\Factory;


class Feedback
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $phone;
    /**
     * @var string
     */
    private $message;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return $this
     */
    public function setPhone(string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return $this
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'phone' => $this->phone,
            'message' => $this->message,
        ];
    }
}
