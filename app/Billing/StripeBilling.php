<?php

namespace App\Billing;

use Config;
use Exception;
use Session;
use Stripe\Charge;
use Stripe\Error\ApiConnection;
use Stripe\Error\Authentication;
use Stripe\Error\Base;
use Stripe\Error\Card;
use Stripe\Error\InvalidRequest;
use Stripe\Error\RateLimit;
use Stripe\Stripe;

class StripeBilling implements BillingInterface {

	public function __construct() {
		//dd(Config::get('services.stripe.secret_key'));
		Stripe::setApiKey(Config::get('services.stripe.secret_key'));
	}

	public function charge(array $data) {
		try
		{
			return Charge::create([
				'amount' => (Session::get('cart')->total * 100),
				'currency' => 'gbp',
				'description' => $data['email'],
				'card' => $data['token'],
			]);
		} catch (Card $e) {
			throw new Exception($e->getMessage());
		} catch (RateLimit $e) {
			throw new Exception($e->getMessage());
		} catch (InvalidRequest $e) {
			throw new Exception($e->getMessage());
		} catch (Authentication $e) {
			throw new Exception($e->getMessage());
		} catch (ApiConnection $e) {
			throw new Exception($e->getMessage());
		} catch (Base $e) {
			throw new Exception($e->getMessage());
		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		}

	}

}
