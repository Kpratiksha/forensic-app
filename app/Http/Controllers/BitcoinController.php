<?php

namespace App\Http\Controllers;

use App\BlockHash;
use App\Transaction;
use App\Wallet;
use Denpa\Bitcoin\Traits\Bitcoind;
use Illuminate\Http\Request;

class BitcoinController extends Controller {
	use Bitcoind;

	public function index() {
		return view('pages.block-height');
	}

	public function searchBlockHeightPage(Request $request) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://pk:pk@52.212.13.157:8332");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, false);
		$data = '{"jsonrpc": "1.0", "id":"", "method": "getblockhash", "params": [' . $request->get('block_height') . '] }';
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/plain'));

		$jsonrpc = json_decode(curl_exec($ch), true);
		if ($jsonrpc['error'] == null) {
			$result = $jsonrpc['result'];
		} else {
			$result = "Invalid request sent!";
		}
		return view('pages.display-block-height', compact('result', 'request'));
	}

	public function showBlockHashPage() {
		return view('pages.block-hash');
	}

	public function searchBlockHash(Request $request) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://pk:pk@52.212.13.157:8332");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, false);
		$data = '{"jsonrpc": "1.0", "id":"curltest", "method": "getblock", "params": ["' . $request->get('block_hash') . '"] }';
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/plain'));
		$jsonrpc = json_decode(curl_exec($ch), true);
		if ($jsonrpc['error'] == null) {
			$result = $jsonrpc['result'];
		} else {
			$result = "Invalid request sent!";
		}
		$result = json_encode($result);

		if ($request->get('metadata') !== null) {
			BlockHash::create($request->all());
		}

		$metadata = BlockHash::where('block_hash', $request->get('block_hash'))->get();
		return view('pages.display-block-hash', compact('result', 'request', 'metadata'));
	}

	public function showTransactionPage() {
		return view('pages.transaction');
	}

	public function searchTransaction(Request $request) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://pk:pk@52.212.13.157:8332");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, false);
		$data = '{"jsonrpc": "1.0", "id":"curltest", "method": "getrawtransaction", "params": ["' . $request->get('tx_id') . '", 1] }';
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/plain'));
		$jsonrpc = json_decode(curl_exec($ch), true);
		if ($jsonrpc['error'] == null) {
			$result = $jsonrpc['result'];
		} else {
			$result = "Invalid request sent!";
		}
		$result = json_encode($result);
		if ($request->get('metadata') !== null) {
			Transaction::create($request->all());
		}
		$metadata = Transaction::where('tx_id', $request->get('tx_id'))->get();
		return view('pages.display-transaction', compact('result', 'request', 'metadata'));
	}

	public function showAddressPage() {
		return view('pages.address');
	}

	public function searchAddress(Request $request) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://pk:pk@52.212.13.157:8332");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, false);
		$data = '{"jsonrpc": "1.0", "id":"curltest", "method": "getaddressinfo", "params": ["' . $request->get('address') . '"] }';
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/plain'));
		$jsonrpc = json_decode(curl_exec($ch), true);
		if ($jsonrpc['error'] == null) {
			$result = $jsonrpc['result'];
		} else {
			$result = "Invalid request sent!";
		}
		$result = json_encode($result);
		if ($request->get('metadata') !== null) {
			Wallet::create($request->all());
		}
		$metadata = Wallet::where('address', $request->get('address'))->get();
		return view('pages.display-address', compact('result', 'request', 'metadata'));
	}

}
