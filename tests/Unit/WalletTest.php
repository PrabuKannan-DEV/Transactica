<?php

namespace Tests\Unit;

use App\Customer;
use App\Wallet;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use phpDocumentor\Reflection\Types\This;
//use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;;
use Carbon\Carbon;
use Exception;

class WalletTest extends TestCase
{
    use RefreshDatabase;

    protected $customer;
    protected $customer2;

    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function testAmountCanBeCredited()
    {
        $this->customer = factory(Customer::class)->create();
        $wallet = $this->customer->wallet()->create(['balance'=>0]);
        self::assertEquals($wallet->balance, 0);
        $wallet->credit(6000);
        self::assertEquals($wallet->balance, 6000);
    }
    public function testAmountCanBeWithdrawn()
    {
        $this->customer = factory(Customer::class)->create();
        $wallet = $this->customer->wallet()->create(['balance'=>0]);
        self::assertEquals($wallet->balance, 0);

        $wallet->credit(6000);
        self::assertEquals($wallet->balance, 6000);

        $wallet->withdrawal(6000);
        self::assertEquals($wallet->balance, 0);

    }

    public function testPartialWithdrawalAndBalanceCheck()
    {
        $this->customer = factory(Customer::class)->create();
        $wallet = $this->customer->wallet()->create(['balance'=>0]);
        self::assertEquals($wallet->balance, 0);

        $wallet->credit(6000);
        self::assertEquals($wallet->balance, 6000);

        $wallet->withdrawal(2000);
        self::assertEquals($wallet->balance, 4000);
    }

    public function testAmountCanBeTransferredFromOneAccountToAnotherAndConfirmBalance()
    {
        $this->customer = factory(Customer::class)->create();
        $this->customer->wallet_activated=1;
        $this->customer->save();
        $wallet = $this->customer->wallet()->create(['balance'=>0]);
        self::assertEquals($wallet->balance, 0);

        $this->customer2 = factory(Customer::class)->create();
        $this->customer2->wallet_activated=1;
        $this->customer2->save();
        $wallet2 = $this->customer2->wallet()->create(['balance'=>0]);
        self::assertEquals($wallet2->balance, 0);
        $wallet2->credit(1000);
        self::assertEquals($wallet2->balance, 1000);

        $wallet->credit(20000);
        self::assertEquals($wallet->balance, 20000);

        $wallet->transfer($this->customer2->id, 14000);
        self::assertEquals($wallet->balance, 6000);//check that sender account is debited
        self::assertEquals($this->customer2->wallet->balance, 15000);//check that recipient account is credited
    }
}
