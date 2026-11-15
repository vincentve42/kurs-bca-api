<?php

namespace App\Service;

use DOMDocument;
use DOMElement;
use DOMXPath;

class ParsingService
{
    public function parse(): array
    {
        $html = file_get_contents('https://www.bca.co.id/id/informasi/kurs');

        if ($html === false) {
            throw new \RuntimeException('Failed to read HTML file');
        }

        $dom = new DOMDocument();

        libxml_use_internal_errors(true);

        $loaded = $dom->loadHTML($html);

        libxml_clear_errors();

        if (!$loaded) {
            throw new \RuntimeException('Failed to parse HTML');
        }

        $xpath = new DOMXPath($dom);

        $rows = $xpath->query(
            '//tr[contains(concat(" ", normalize-space(@class), " "), " m-table-body-row ")]'
        );

        $data = [];

        foreach ($rows as $row) {

            if (!$row instanceof DOMElement) {
                continue;
            }

            $code = $row->getAttribute('code');

            $getValue = function ($type) use ($xpath, $row) {
                $result = $xpath->query(
                    ".//td[@rate-type='$type']",
                    $row
                );

                return $result && $result->length > 0
                    ? trim($result->item(0)->textContent)
                    : null;
            };

            $data[$code] = [
                'eRateBuy' => $getValue('eRate-buy'),
                'eRateSell' => $getValue('eRate-sell'),
                'ttCounterBuy' => $getValue('TTCounter-buy'),
                'ttCounterSell' => $getValue('TTCounter-sell'),
                'bankNotesBuy' => $getValue('BankNotes-buy'),
                'bankNotesSell' => $getValue('BankNotes-sell'),
            ];
        }
        return $data;
    }
}
