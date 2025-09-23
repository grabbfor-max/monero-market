<?php

namespace Database\Seeders;

use App\Models\MarketPlace;
use Illuminate\Database\Seeder;

class MarketPlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pgp = "-----BEGIN PGP PUBLIC KEY BLOCK-----

mQENBGIFS18BCACb9onKrextETGfGlG/dXEv5bGO8YyTgXCcC9E06CGobhTIpE3z
+MtCo+Z1kaZ4XK5mv0DvmJAkfSL7oO+NWzqSGFuloL1TIo8yjTuy+3wj4iXb7INa
K9a5GySQ/BB7xw6KOojz+5dbyU4IOgYByNttyBZ19xumN/8JkVztWVbjbAHitYtM
EIABgOgtLfNl+HOQ9fzMHcLwv2od2A5W0jayGtQsSn8WTRhwgkyBT5Gb/pC4jKpy
XeZNWRKxle67Q3Msu1oTR+guDjjeFKdxCozKN7/irDVE/HCDxaPUa5a2a/ogIKfk
XCApH2hSftE8CwCyP2Sh22ExDJetKT74n+DnABEBAAG0DGFzZGFzZGFzZGFzZIkB
TgQTAQgAOBYhBIPdq405a5TT7Z4tgyt85Z28cE/MBQJiBUtfAhsDBQsJCAcCBhUK
CQgLAgQWAgMBAh4BAheAAAoJECt85Z28cE/M2qQH/1Jlq2ELjYX8CYzxbHVL6QUK
6J8BRuR/3mVYkDWBS8b61oEcCgFxb7jUEQMFFgfs+Hi8Ll9M5omu4rAq2/Nnv46X
Ai4QkszcMz2RyXPJpjjO7Kwpwl6eJw4AA5j4tlHgWKndztLYsgGAPKi7FmEx6NuF
xFccLaPqvw/wjIHOCkDw/hh0ZVZWUOl05Ki9XyR+brApk9rZZRzogDZXTNaCcZuL
qUWyml+LzXxfwFax2b3nBKjzC/McG2sju4qwl6nCKby3muPUL/Eg45Q+6BiVBJQL
bUE/vXSNt7g1MQANHCjLhx6WqFtZJdszHJIc1Aj1MEiCek8Q+oM3x47bPlMDF8W5
AQ0EYgVLXwEIALGRjsb+a7TUMMoSPRK/PrqESp9rcaqpwYVYV6mdPOaP2//BgkJz
cXFTQm38onn6KRSwEBeC1EALgKojfmlmDia2hdzkwiKWyVb7VuihqxeOoR6BiRGY
kYEAmcM4Z1gNySik2CYFIdH+ThWi75S+1npVri+yxIN8OLFn35qdjjfQaw70Qn9e
o4nsjx9jRzO1kQVGBihOz9yuEtsMDfAMPgwzN2vVGFaVdIPwKAADMVeKqMnHzXHc
hCEb5yqSp0XitCLbPZ77ULHuhyzRfkzsXmVg/e+wmaBnbPserZRO5j4vFC4AFAFh
zCkspeXVT7YnoB8YpQxK/rKRhJenovScHN0AEQEAAYkBNgQYAQgAIBYhBIPdq405
a5TT7Z4tgyt85Z28cE/MBQJiBUtfAhsMAAoJECt85Z28cE/MK74H/RtdUMV6MLKR
aXC9fmNh1zqk0NnZUuPxQGprwWmpyLCmXnqTE44j5mfhLhJr7rUNbWWQzjHG4Q23
b6rxk9F9oeQ02zlI27wabIj4ab/4tLcaGAOm/l3iuM88K8NqcO+SNXsQEhjz05bF
XN/vBGmEmQmkZrmeWkv5Yftz0joeNpjtYftZkCBEhf4InIgUmugT6W1CbiZQwv5R
M6xJVgmW3zkZI6VcjsX8Qn5WkJbqzuwE5S2DXFvEna6Lecnj3Ay78AOzZwC1Ugjt
bX9nxefKVecXdvOlKPVw7H0BWbTAALY2/STrgNAP7KCE71yCZWPDnNYByq1GJ9FQ
EXnBGgyUH58=
=Pdgp
-----END PGP PUBLIC KEY BLOCK-----";

        $articles = [
            [
                'title' => 'Title 1: Lorem ipsum dolor sit amet',
                'description' => 'Laoreet suspendisse interdum consectetur libero id. Ac feugiat sed lectus vestibulum mattis ullamcorper velit sed ullamcorper. Viverra nibh cras pulvinar mattis nunc sed blandit. Proin sagittis nisl rhoncus mattis rhoncus urna neque viverra.',
                'published' => true
            ],
            [
                'title' => 'Title 2: Consectetur adipiscing elit',
                'description' => 'Arcu felis bibendum ut tristique et egestas quis. Fames ac turpis egestas sed tempus urna et pharetra. Eu non diam phasellus vestibulum lorem sed risus ultricies tristique. Ac turpis egestas integer eget aliquet nibh praesent tristique magna.',
                'published' => true
            ],
            [
                'title' => 'Title 3: Sed do eiusmod tempor incididunt',
                'description' => 'Tincidunt augue interdum velit euismod in. Ipsum consequat nisl vel pretium lectus quam id. Diam sit amet nisl suscipit adipiscing bibendum est. Molestie at elementum eu facilisis sed odio morbi quis commodo. Eu mi bibendum neque egestas congue quisque egestas diam in.',
                'published' => true
            ],
            [
                'title' => 'Title 4: Ut labore et dolore magna aliqua',
                'description' => 'Eleifend donec pretium vulputate sapien nec sagittis aliquam. Risus commodo viverra maecenas accumsan lacus vel facilisis. Enim diam vulputate ut pharetra. At risus viverra adipiscing at in tellus integer feugiat scelerisque.',
                'published' => true
            ],
        ];

        $jsonArticles = json_encode($articles);

        $this->command->info('Creating Market Info...');
        $marketInfo = new MarketPlace;
        $marketInfo->pgp = $pgp;
        $marketInfo->articles = $jsonArticles;
        $marketInfo->footer = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere, illo. Laborum ratione corrupti quasi ullam? Voluptatum iusto at aperiam voluptas.';
        $marketInfo->save();
    }
}
