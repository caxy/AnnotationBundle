<?php

namespace Caxy\AnnotationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Annotation.
 *
 * @ORM\Table(name="caxy_annotation")
 * @ORM\Entity()
 */
class Annotation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="start", type="text")
     */
    protected $start;

    /**
     * @var string
     *
     * @ORM\Column(name="start_offset", type="integer")
     */
    protected $start_offset;

    /**
     * @var string
     *
     * @ORM\Column(name="end", type="text")
     */
    protected $end;

    /**
     * @var string
     *
     * @ORM\Column(name="end_offset", type="integer")
     */
    protected $end_offset;

    /**
     * @var string
     *
     * @ORM\Column(name="quote", type="text")
     */
    protected $quote;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="text")
     */
    protected $url;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text")
     */
    protected $text;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set start.
     *
     * @param string $start
     *
     * @return Annotation
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start.
     *
     * @return string
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set start_offset.
     *
     * @param int $start_offset
     *
     * @return Annotation
     */
    public function setStartOffset($start_offset)
    {
        $this->start_offset = $start_offset;

        return $this;
    }

    /**
     * Get start_offset.
     *
     * @return int
     */
    public function getStartOffset()
    {
        return $this->start_offset;
    }

    /**
     * Set end.
     *
     * @param string $end
     *
     * @return Annotation
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end.
     *
     * @return string
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Set end_offset.
     *
     * @param int $end_offset
     *
     * @return Annotation
     */
    public function setEndOffset($end_offset)
    {
        $this->end_offset = $end_offset;

        return $this;
    }

    /**
     * Get end_offset.
     *
     * @return int
     */
    public function getEndOffset()
    {
        return $this->end_offset;
    }

    /**
     * Set quote.
     *
     * @param string $quote
     *
     * @return Annotation
     */
    public function setQuote($quote)
    {
        $this->quote = $quote;

        return $this;
    }

    /**
     * Get quote.
     *
     * @return string
     */
    public function getQuote()
    {
        return $this->quote;
    }

    /**
     * Set url.
     *
     * @param string $url
     *
     * @return Annotation
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set text.
     *
     * @param string $text
     *
     * @return Annotation
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text.
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }
}
