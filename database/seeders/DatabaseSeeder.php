<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Laundry;
use App\Models\LaundryService;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Database\Factories\LaundryServiceFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(1)->create([
            'name' => "Naufal",
            'email' => "nfalldh@gmail.com",
            'phone_number' => "085244118541",
            'role' => "admin"
        ]);

        $data = '[{"lat": 5.5275731366585585,"lng": 95.32873660326004},{"lat": 5.5275731366585585,"lng": 95.33017963171005},{"lat": 5.528849640899939,"lng": 95.33149391412736},{"lat": 5.530163529419855,"lng": 95.33203035593034},{"lat": 5.530638878612942,"lng": 95.33115595579149},{"lat": 5.5316857136916635,"lng": 95.3321322798729},{"lat": 5.532278563348401,"lng": 95.33325344324113},{"lat": 5.530815131587502,"lng": 95.33463746309282},{"lat": 5.530302395515751,"lng": 95.33625215291977},{"lat": 5.531562870895703,"lng": 95.33680468797684},{"lat": 5.533384146256143,"lng": 95.33619850873949},{"lat": 5.533597785227107,"lng": 95.33472329378128},{"lat": 5.53536030379265,"lng": 95.33482521772386},{"lat": 5.536118719255539,"lng": 95.33400982618332},{"lat": 5.5366741778505,"lng": 95.3329047560692},{"lat": 5.537299068145877,"lng": 95.33174604177475},{"lat": 5.537737025053135,"lng": 95.33088237047195},{"lat": 5.539371349182748,"lng": 95.33137053251266},{"lat": 5.540428850622238,"lng": 95.33076971769334},{"lat": 5.540492941557703,"lng": 95.32913357019424},{"lat": 5.541459645657726,"lng": 95.32792121171951},{"lat": 5.5429070283960735,"lng": 95.32822161912918},{"lat": 5.542575893174819,"lng": 95.32621532678604},{"lat": 5.540978964258825,"lng": 95.32576471567155},{"lat": 5.539707827118846,"lng": 95.3252336382866},{"lat": 5.538292482127156,"lng": 95.32515317201614},{"lat": 5.536588722716021,"lng": 95.3250727057457},{"lat": 5.536001218332014,"lng": 95.32492250204086},{"lat": 5.5353549628352345,"lng": 95.32478839159012},{"lat": 5.534607228321077,"lng": 95.32415002584459},{"lat": 5.533619149119966,"lng": 95.32455235719681},{"lat": 5.532385383043197,"lng": 95.32384961843492},{"lat": 5.53217174363431,"lng": 95.32471328973772},{"lat": 5.531290480257134,"lng": 95.3252711892128},{"lat": 5.530120801383788,"lng": 95.32587736845018},{"lat": 5.529314309124487,"lng": 95.32524973154068},{"lat": 5.5295493136049085,"lng": 95.3245684504509},{"lat": 5.530056709323906,"lng": 95.3234687447548},{"lat": 5.530964679524739,"lng": 95.32269090414047},{"lat": 5.53142400509563,"lng": 95.32143026590347},{"lat": 5.530948656533273,"lng": 95.32074898481369},{"lat": 5.529939207196096,"lng": 95.32106012105942},{"lat": 5.528555884937598,"lng": 95.32141417264938},{"lat": 5.528005759743282,"lng": 95.32052367925645},{"lat": 5.529116691648291,"lng": 95.31967610120773},{"lat": 5.5300032992687065,"lng": 95.31929522752763},{"lat": 5.530633537612901,"lng": 95.31908065080644},{"lat": 5.5315895758535065,"lng": 95.31897336244583},{"lat": 5.532428110915713,"lng": 95.31882852315903},{"lat": 5.5336832407939,"lng": 95.31837254762651},{"lat": 5.534612569285267,"lng": 95.31881242990494},{"lat": 5.535584623960479,"lng": 95.3183564543724},{"lat": 5.5356967840124565,"lng": 95.31763225793839},{"lat": 5.535413713364139,"lng": 95.31669348478317},{"lat": 5.533603126200393,"lng": 95.31621068716049},{"lat": 5.531781851514199,"lng": 95.3162482380867},{"lat": 5.530435920577198,"lng": 95.31711727380753},{"lat": 5.5289831662891675,"lng": 95.31791657209398},{"lat": 5.528235423721508,"lng": 95.31743377447128},{"lat": 5.527290062123386,"lng": 95.31756252050401},{"lat": 5.5262058319915095,"lng": 95.31840473413469},{"lat": 5.5253566060191766,"lng": 95.31713873147964},{"lat": 5.5242243028286495,"lng": 95.31636089086533},{"lat": 5.523027904653276,"lng": 95.31577080488206},{"lat": 5.522290836717664,"lng": 95.31699925661088},{"lat": 5.5223976582144045,"lng": 95.31819552183153},{"lat": 5.520731240672626,"lng": 95.3171816468239},{"lat": 5.5192731214807145,"lng": 95.31755715608598},{"lat": 5.517750905311987,"lng": 95.31806677579881},{"lat": 5.51725952241633,"lng": 95.31667202711107},{"lat": 5.51766544744634,"lng": 95.31527727842332},{"lat": 5.516431648138914,"lng": 95.31390935182571},{"lat": 5.514679755536569,"lng": 95.313780605793},{"lat": 5.513114798320229,"lng": 95.31370013952257},{"lat": 5.513782442688518,"lng": 95.31302958726883},{"lat": 5.5135794788800165,"lng": 95.311795771122},{"lat": 5.513851877659719,"lng": 95.31056195497514},{"lat": 5.512292259426045,"lng": 95.30959099531174},{"lat": 5.512922516602863,"lng": 95.3088828921318},{"lat": 5.5119717894185145,"lng": 95.30834645032883},{"lat": 5.510732637095338,"lng": 95.30828744173051},{"lat": 5.51008635403876,"lng": 95.30868977308273},{"lat": 5.509060845596688,"lng": 95.30856639146805},{"lat": 5.5084412667216975,"lng": 95.3079816699028},{"lat": 5.5089326569169375,"lng": 95.30750960111618},{"lat": 5.510145107072968,"lng": 95.30651718378068},{"lat": 5.511240048919627,"lng": 95.30521363019943},{"lat": 5.512121342110223,"lng": 95.3052780032158},{"lat": 5.511993154091067,"lng": 95.30421048402786},{"lat": 5.512805011078271,"lng": 95.30391544103624},{"lat": 5.51423109928214,"lng": 95.3036579489708},{"lat": 5.515422174069712,"lng": 95.3036579489708},{"lat": 5.516431648138914,"lng": 95.30357748270036},{"lat": 5.517414414894774,"lng": 95.30316978693008},{"lat": 5.518242287800545,"lng": 95.30318588018419},{"lat": 5.519481424441972,"lng": 95.30338436365129},{"lat": 5.519892689048037,"lng": 95.30268698930742},{"lat": 5.520715217404305,"lng": 95.30188769102097},{"lat": 5.521025000515333,"lng": 95.30112057924272},{"lat": 5.521655248413933,"lng": 95.30015498399734},{"lat": 5.522461751103221,"lng": 95.30024081468584},{"lat": 5.523519282767668,"lng": 95.29991358518602},{"lat": 5.524149528013463,"lng": 95.299189388752}]';

        $coords = json_decode($data, true);

        foreach ($coords as $item) {
            User::factory(1)->create([
                'role' => 'laundry'
            ])->each(function ($user) use ($item) {
                Laundry::factory(1)->create([
                    'user_id' => $user->id,
                    'lat' => $item['lat'],
                    'long' => $item['lng'],
                ])->each(function ($laundry) {
                    for ($i = 0; $i < 3; $i++) {
                        LaundryService::factory(1)->create([
                            'laundry_id' => $laundry->id,
                        ]);
                    }
                });
            });
        }

        // User::factory()
        // \App\Models\User::factory(10)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // $user = User::where('role', '!=', 'laundry')->get();
        // for ($i = 0; $i < 5; $i++) {
        //     $order = Order::create([
        //         'user_id' => $user->random()->id,
        //         'laundry_id' => 2,
        //         'status' => Arr::random(['terima', 'cuci', 'setrika', 'selesai']),
        //         'is_paid' => Arr::random([true, false]),
        //         'is_pickedup' => Arr::random([true, false]),
        //     ]);

        //     for ($o = 0; $o < rand(1, 3); $o++) {
        //         $service = LaundryService::find(Arr::random([1, 5, 6]));
        //         $kilos = rand(5, 20);
        //         OrderDetail::create([
        //             'order_id' => $order->id,
        //             'service_id' => $service->id,
        //             'weight' => $kilos,
        //             'price' => $service->price * $kilos,
        //         ]);
        //     }
        // }
    }
}
