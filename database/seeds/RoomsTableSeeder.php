<?php

use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rooms = [
            array('name' => 'A0-1', 'capacity' => 30, 'arrangement' =>
                'c[1,1]c[2,2]c[3,3]c[4,4]c[5,5]++c[6,6]c[7,7]c[8,8]c[9,9]c[10,10]++c[11,11]c[12,12]c[13,13]c[14,14]c[15,15]++c[16,16]c[17,17]c[18,18]c[19,19]c[20,20]++c[21,21]c[22,22]c[23,23]c[24,24]c[25,25]++c[26,26]c[27,27]c[28,28]c[29,29]c[30,30]',
                'description' => 'Perspektywa z poziomu komputera prowadzącego - numery 1-5 to najdalszy rząd pod ścianą.'
            ),
            array('name' => 'A0-11', 'capacity' => 24, 'arrangement' =>
                'c[1,1]c[2,2]c[3,3]c[4,4]c[5,5]c[6,6]++_++c[7,7]c[8,8]c[9,9]c[10,10]c[11,11]c[12,12]++c[13,13]c[14,14]c[15,15]c[16,16]c[17,17]c[18,18]++c[19,19]c[20,20]c[21,21]c[22,22]c[23,23]++c[24,24]', 'description' => ''
            ),
            array('name' => 'A0-12', 'capacity' => 24, 'arrangement' => 'c[1,1]c[2,2]c[3,3]c[4,4]c[5,5]c[6,6]++_++c[7,7]c[8,8]c[9,9]c[10,10]c[11,11]c[12,12]++c[13,13]c[14,14]c[15,15]c[16,16]c[17,17]c[18,18]++c[19,19]c[20,20]c[21,21]++c[22,22]c[23,23]c[24,24]', 'description' => ''),
            array('name' => 'A0-3', 'capacity' => 13, 'arrangement' => 'c[1,1]c[2,2]c[3,3]c[4,4]c[5,5]c[6,6]++_++c[7,7]c[8,8]c[9,9]c[10,10]c[11,11]++c[12,12]c[13,13]', 'description' => ''),
            array('name' => 'A0-5', 'capacity' => 13, 'arrangement' => 'c[1,1]c[2,2]c[3,3]c[4,4]c[5,5]c[6,6]++_++c[7,7]c[8,8]c[9,9]c[10,10]c[11,11]++c[12,12]c[13,13]', 'description' => ''),
            array('name' => 'A1-14/15', 'capacity' => 26, 'arrangement' =>
                'c[1,1]c[2,2]c[3,3]c[4,4]c[5,5]++_++c[6,6]c[7,7]c[8,8]c[9,9]_++c[10,10]c[11,11]c[12,12]c[13,13]_++_++c[14,14]c[15,15]c[16,16]c[17,17]c[18,18]++_++c[19,19]c[20,20]c[21,21]c[22,22]_++c[23,23]c[24,24]c[25,25]c[26,26]_',
                'description' => 'Perspektywa z poziomu komputera prowadzącego (nr 13) - numery 1-5 to rząd pod ścianą, numery 14-18 to rząd pod szybą w drugiej części sali.'
            ),
            array('name' => 'A1-16/17', 'capacity' => 26, 'arrangement' =>
                'c[1,1]c[2,2]c[3,3]c[4,4]c[5,5]++_++c[6,6]c[7,7]c[8,8]c[9,9]_++c[10,10]c[11,11]c[12,12]c[13,13]_++_++c[14,14]c[15,15]c[16,16]c[17,17]c[18,18]++_++c[19,19]c[20,20]c[21,21]c[22,22]_++c[23,23]c[24,24]c[25,25]c[26,26]_',
                'description' => 'Perspektywa z poziomu komputera prowadzącego (nr 13) - numery 1-5 to rząd pod ścianą, numery 14-18 to rząd pod szybą w drugiej części sali.'
            ),
            array('name' => 'A1-18', 'capacity' => 13, 'arrangement' => 'c[1,1]c[2,2]c[3,3]c[4,4]c[5,5]c[6,6]++_++c[7,7]c[8,8]c[9,9]c[10,10]c[11,11]++c[12,12]c[13,13]', 'description' => ''),
            array('name' => 'A1-20', 'capacity' => 13, 'arrangement' => 'c[1,1]c[2,2]c[3,3]c[4,4]c[5,5]c[6,6]++_++c[7,7]c[8,8]c[9,9]c[10,10]c[11,11]++c[12,12]c[13,13]', 'description' => ''),
            array('name' => 'A1-22/23', 'capacity' => 26, 'arrangement' =>
                'c[1,1]c[2,2]c[3,3]c[4,4]c[5,5]++_++c[6,6]c[7,7]c[8,8]c[9,9]_++c[10,10]c[11,11]c[12,12]c[13,13]_++_++c[14,14]c[15,15]c[16,16]c[17,17]c[18,18]++_++c[19,19]c[20,20]c[21,21]c[22,22]_++c[23,23]c[24,24]c[25,25]c[26,26]_',
                'description' => 'Perspektywa z poziomu komputera prowadzącego (nr 13) - numery 1-5 to rząd pod ścianą, numery 14-18 to rząd pod szybą w drugiej części sali.'
            ),
            array('name' => 'A1-24/25', 'capacity' => 26, 'arrangement' =>
                'c[1,1]c[2,2]c[3,3]c[4,4]c[5,5]++_++c[6,6]c[7,7]c[8,8]c[9,9]_++c[10,10]c[11,11]c[12,12]c[13,13]_++_++c[14,14]c[15,15]c[16,16]c[17,17]c[18,18]++_++c[19,19]c[20,20]c[21,21]c[22,22]_++c[23,23]c[24,24]c[25,25]c[26,26]_',
                'description' => 'Perspektywa z poziomu komputera prowadzącego (nr 13) - numery 1-5 to rząd pod ścianą, numery 14-18 to rząd pod szybą w drugiej części sali.'
            ),
            array('name' => 'A1-33 (Sala RW)', 'capacity' => 64, 'arrangement' => '', 'description' => ''),
            array('name' => 'A2-1', 'capacity' => 24, 'arrangement' => 'c[1,1]c[2,2]c[3,3]c[4,4]c[5,5]c[6,6]++_++c[7,7]c[8,8]c[9,9]c[10,10]c[11,11]c[12,12]++c[13,13]c[14,14]c[15,15]c[16,16]c[17,17]c[18,18]++c[19,19]c[20,20]c[21,21]c[22,22]c[23,23]++c[24,24]', 'description' => ''),
            array('name' => 'A2-10', 'capacity' => 34, 'arrangement' => 'c[1,1]c[2,2]c[3,3]c[4,4]c[5,5]c[6,6]++_++c[7,7]c[8,8]c[9,9]c[10,10]c[11,11]c[12,12]++c[13,13]c[14,14]c[15,15]c[16,16]c[17,17]c[18,18]++c[19,19]c[20,20]c[21,21]c[22,22]c[23,23]c[24,24]++_++c[25,25]c[26,26]c[27,27]c[28,28]c[29,29]c[30,30]++c[31,31]c[32,32]c[33,33]c[34,34]', 'description' => ''),
            array('name' => 'A2-11', 'capacity' => 34, 'arrangement' => 'c[1,1]c[2,2]c[3,3]c[4,4]c[5,5]c[6,6]++_++c[7,7]c[8,8]c[9,9]c[10,10]c[11,11]c[12,12]++c[13,13]c[14,14]c[15,15]c[16,16]c[17,17]c[18,18]++c[19,19]c[20,20]c[21,21]c[22,22]c[23,23]c[24,24]++_++c[25,25]c[26,26]c[27,27]c[28,28]c[29,29]c[30,30]++c[31,31]c[32,32]c[33,33]c[34,34]', 'description' => ''),
            array('name' => 'A2-12', 'capacity' => 34, 'arrangement' => 'c[1,1]c[2,2]c[3,3]c[4,4]c[5,5]c[6,6]++_++c[7,7]c[8,8]c[9,9]c[10,10]c[11,11]c[12,12]++c[13,13]c[14,14]c[15,15]c[16,16]c[17,17]c[18,18]++c[19,19]c[20,20]c[21,21]c[22,22]c[23,23]c[24,24]++_++c[25,25]c[26,26]c[27,27]c[28,28]c[29,29]c[30,30]++c[31,31]c[32,32]c[33,33]c[34,34]', 'description' => ''),
            array('name' => 'A2-14', 'capacity' => 48, 'arrangement' => 'c[1,1]c[2,2]c[3,3]c[4,4]_c[5,5]c[6,6]c[7,7]c[8,8]++c[9,9]c[10,10]c[11,11]c[12,12]_c[13,13]c[14,14]c[15,15]c[16,16]++c[17,17]c[18,18]c[19,19]c[20,20]_c[21,21]c[22,22]c[23,23]c[24,24]++c[25,25]c[26,26]c[27,27]c[28,28]_c[29,29]c[30,30]c[31,31]c[32,32]++c[33,33]c[34,34]c[35,35]c[36,36]_c[37,37]c[38,38]c[39,39]c[40,40]++c[41,41]c[42,42]c[43,43]c[44,44]_c[45,45]c[46,46]c[47,47]c[48,48]',
                'description' => 'Perspektywa z poziomu komputera prowadzącego - numery 1-8 to rząd pod ścianą.'
            ),
            array('name' => 'A2-19', 'capacity' => 48, 'arrangement' => 'c[1,1]c[2,2]c[3,3]c[4,4]_c[5,5]c[6,6]c[7,7]c[8,8]++c[9,9]c[10,10]c[11,11]c[12,12]_c[13,13]c[14,14]c[15,15]c[16,16]++c[17,17]c[18,18]c[19,19]c[20,20]_c[21,21]c[22,22]c[23,23]c[24,24]++c[25,25]c[26,26]c[27,27]c[28,28]_c[29,29]c[30,30]c[31,31]c[32,32]++c[33,33]c[34,34]c[35,35]c[36,36]_c[37,37]c[38,38]c[39,39]c[40,40]++c[41,41]c[42,42]c[43,43]c[44,44]_c[45,45]c[46,46]c[47,47]c[48,48]',
                'description' => 'Perspektywa z poziomu komputera prowadzącego - numery 1-8 to rząd pod ścianą.'
            ),
            array('name' => 'A2-2', 'capacity' => 34, 'arrangement' => 'c[1,1]c[2,2]c[3,3]c[4,4]c[5,5]c[6,6]++_++c[7,7]c[8,8]c[9,9]c[10,10]c[11,11]c[12,12]++c[13,13]c[14,14]c[15,15]c[16,16]c[17,17]c[18,18]++c[19,19]c[20,20]c[21,21]c[22,22]c[23,23]c[24,24]++_++c[25,25]c[26,26]c[27,27]c[28,28]c[29,29]c[30,30]++c[31,31]c[32,32]c[33,33]c[34,34]', 'description' => ''),
            array('name' => 'A2-20', 'capacity' => 32, 'arrangement' => 'c[1,1]c[2,2]c[3,3]c[4,4]c[5,5]c[6,6]++_++c[7,7]c[8,8]c[9,9]c[10,10]c[11,11]c[12,12]++c[13,13]c[14,14]c[15,15]c[16,16]c[17,17]c[18,18]++c[19,19]c[20,20]c[21,21]c[22,22]c[23,23]c[24,24]++_++c[25,25]c[26,26]c[27,27]c[28,28]c[29,29]c[30,30]++c[31,31]c[32,32]', 'description' => ''),
            array('name' => 'A2-21', 'capacity' => 48, 'arrangement' => '_____c[1,1]c[2,2]c[3,3]c[4,4]++_____c[5,5]c[6,6]c[7,7]c[8,8]++c[9,9]c[10,10]c[11,11]c[12,12]_c[13,13]c[14,14]c[15,15]c[16,16]++c[17,17]c[18,18]c[19,19]c[20,20]_c[21,21]c[22,22]c[23,23]c[24,24]++c[25,25]c[26,26]c[27,27]c[28,28]_c[29,29]c[30,30]c[31,31]c[32,32]++c[33,33]c[34,34]c[35,35]c[36,36]_c[37,37]c[38,38]c[39,39]c[40,40]++c[41,41]c[42,42]c[43,43]c[44,44]_c[45,45]c[46,46]c[47,47]c[48,48]',
                'description' => 'Perspektywa z poziomu komputera prowadzącego - numery 1-4 to rząd pod ścianą.'
                ),
            array('name' => 'A2-22', 'capacity' => 48, 'arrangement' => '_____c[1,1]c[2,2]c[3,3]c[4,4]++_____c[5,5]c[6,6]c[7,7]c[8,8]++c[9,9]c[10,10]c[11,11]c[12,12]_c[13,13]c[14,14]c[15,15]c[16,16]++c[17,17]c[18,18]c[19,19]c[20,20]_c[21,21]c[22,22]c[23,23]c[24,24]++c[25,25]c[26,26]c[27,27]c[28,28]_c[29,29]c[30,30]c[31,31]c[32,32]++c[33,33]c[34,34]c[35,35]c[36,36]_c[37,37]c[38,38]c[39,39]c[40,40]++c[41,41]c[42,42]c[43,43]c[44,44]_c[45,45]c[46,46]c[47,47]c[48,48]',
                'description' => 'Perspektywa z poziomu komputera prowadzącego - numery 1-4 to rząd pod ścianą.'
                ),
            array('name' => 'A2-23', 'capacity' => 48, 'arrangement' => '_____c[1,1]c[2,2]c[3,3]c[4,4]++_____c[5,5]c[6,6]c[7,7]c[8,8]++c[9,9]c[10,10]c[11,11]c[12,12]_c[13,13]c[14,14]c[15,15]c[16,16]++c[17,17]c[18,18]c[19,19]c[20,20]_c[21,21]c[22,22]c[23,23]c[24,24]++c[25,25]c[26,26]c[27,27]c[28,28]_c[29,29]c[30,30]c[31,31]c[32,32]++c[33,33]c[34,34]c[35,35]c[36,36]_c[37,37]c[38,38]c[39,39]c[40,40]++c[41,41]c[42,42]c[43,43]c[44,44]_c[45,45]c[46,46]c[47,47]c[48,48]',
                'description' => 'Perspektywa z poziomu komputera prowadzącego - numery 1-4 to rząd pod ścianą.'
                ),
            array('name' => 'A2-24', 'capacity' => 48, 'arrangement' => '_____c[1,1]c[2,2]c[3,3]c[4,4]++_____c[5,5]c[6,6]c[7,7]c[8,8]++c[9,9]c[10,10]c[11,11]c[12,12]_c[13,13]c[14,14]c[15,15]c[16,16]++c[17,17]c[18,18]c[19,19]c[20,20]_c[21,21]c[22,22]c[23,23]c[24,24]++c[25,25]c[26,26]c[27,27]c[28,28]_c[29,29]c[30,30]c[31,31]c[32,32]++c[33,33]c[34,34]c[35,35]c[36,36]_c[37,37]c[38,38]c[39,39]c[40,40]++c[41,41]c[42,42]c[43,43]c[44,44]_c[45,45]c[46,46]c[47,47]c[48,48]',
                'description' => 'Perspektywa z poziomu komputera prowadzącego - numery 1-4 to rząd pod ścianą.'
                ),
            array('name' => 'A2-4', 'capacity' => 24, 'arrangement' => 'c[1,1]c[2,2]c[3,3]c[4,4]c[5,5]c[6,6]++_++c[7,7]c[8,8]c[9,9]c[10,10]c[11,11]c[12,12]++c[13,13]c[14,14]c[15,15]c[16,16]c[17,17]c[18,18]++c[19,19]c[20,20]c[21,21]c[22,22]c[23,23]++c[24,24]', 'description' => ''),
            array('name' => 'A2-5', 'capacity' => 24, 'arrangement' => 'c[1,1]c[2,2]c[3,3]c[4,4]c[5,5]c[6,6]++_++c[7,7]c[8,8]c[9,9]c[10,10]c[11,11]c[12,12]++c[13,13]c[14,14]c[15,15]c[16,16]c[17,17]c[18,18]++c[19,19]c[20,20]c[21,21]c[22,22]c[23,23]++c[24,24]', 'description' => ''),
            array('name' => 'A2-8', 'capacity' => 24, 'arrangement' => 'c[1,1]c[2,2]c[3,3]c[4,4]c[5,5]c[6,6]++_++c[7,7]c[8,8]c[9,9]c[10,10]c[11,11]c[12,12]++c[13,13]c[14,14]c[15,15]c[16,16]c[17,17]c[18,18]++c[19,19]c[20,20]c[21,21]c[22,22]c[23,23]++c[24,24]', 'description' => ''),
            array('name' => 'A2-9', 'capacity' => 34, 'arrangement' => '', 'description' => ''),
            array('name' => 'Aula A', 'capacity' => 196, 'arrangement' => 'c[1,1]c[2,2]c[3,3]c[4,4]c[5,5]c[6,6]++_++c[7,7]c[8,8]c[9,9]c[10,10]c[11,11]c[12,12]++c[13,13]c[14,14]c[15,15]c[16,16]c[17,17]c[18,18]++c[19,19]c[20,20]c[21,21]c[22,22]c[23,23]c[24,24]++_++c[25,25]c[26,26]c[27,27]c[28,28]c[29,29]c[30,30]++c[31,31]c[32,32]c[33,33]c[34,34]++c[35,35]c[36,36]c[37,37]c[38,38]c[39,39]c[40,40]++c[41,41]c[42,42]c[43,43]c[44,44]++c[45,45]c[46,46]c[47,47]c[48,48]c[49,49]c[50,50]++c[51,51]c[52,52]c[53,53]c[54,54]++c[55,55]c[56,56]c[57,57]c[58,58]c[59,59]c[60,60]++c[61,61]c[62,62]c[63,63]c[64,64]++c[65,65]c[66,66]c[67,67]c[68,68]c[69,69]c[70,70]++c[71,71]c[72,72]c[73,73]c[74,74]++c[75,75]c[76,76]c[77,77]c[78,78]c[79,79]c[80,80]++c[81,81]c[82,82]c[83,83]c[84,84]++c[85,85]c[86,86]c[87,87]c[88,88]c[89,89]c[90,90]++c[91,91]c[92,92]c[93,93]c[94,94]++c[95,95]c[96,96]c[97,97]c[98,98]c[99,99]c[100,100]++c[101,101]c[102,102]c[103,103]c[104,104]++c[105,105]c[106,106]c[107,107]c[108,108]c[109,109]c[110,110]++c[111,111]c[112,112]c[113,113]c[114,114]++c[115,115]c[116,116]c[117,117]c[118, 118]c[119,119]c[120,120]++c[121,121]c[122,122]c[123,123]c[124,124]++c[125,125]c[126,126]c[127,127]c[128,128]c[129,129]c[130,130]++c[131,131]c[132,132]c[133,133]c[134,134]++c[135,135]c[136,136]c[137,137]c[138,138]c[139,139]c[140,140]++c[141,141]c[142,142]c[143,143]c[144,144]++c[145,145]c[146,146]c[147,147]c[148,148]c[149,149]c[150,150]++c[151,151]c[152,152]c[153,153]c[154,154]++c[155,155]c[156,156]c[157,157]c[158,158]c[159,159]c[160,160]++c[161,161]c[162,162]c[163,163]c[164,164]++c[165,165]c[166,166]c[167,167]c[168,168]c[169,169]c[170,170]++c[171,171]c[172,172]c[173,173]c[174,174]++c[175,175]c[176,176]c[177,177]c[178,178]c[179,179]c[180,180]++c[181,181]c[182,182]c[183,183]c[184,184]++c[185,185]c[186,186]c[187,187]c[188,188]c[189,189]c[190,190]++c[191,191]c[192,192]c[193,193]c[194,194]++c[195,195]c[196,196]', 'description' => ''),
            array('name' => 'Aula B', 'capacity' => 117, 'arrangement' => 'c[1,1]c[2,2]c[3,3]c[4,4]c[5,5]c[6,6]++_++c[7,7]c[8,8]c[9,9]c[10,10]c[11,11]c[12,12]++c[13,13]c[14,14]c[15,15]c[16,16]c[17,17]c[18,18]++c[19,19]c[20,20]c[21,21]c[22,22]c[23,23]c[24,24]++_++c[25,25]c[26,26]c[27,27]c[28,28]c[29,29]c[30,30]++c[31,31]c[32,32]c[33,33]c[34,34]++c[35,35]c[36,36]c[37,37]c[38,38]c[39,39]c[40,40]++c[41,41]c[42,42]c[43,43]c[44,44]++c[45,45]c[46,46]c[47,47]c[48,48]c[49,49]c[50,50]++c[51,51]c[52,52]c[53,53]c[54,54]++c[55,55]c[56,56]c[57,57]c[58,58]c[59,59]c[60,60]++c[61,61]c[62,62]c[63,63]c[64,64]++c[65,65]c[66,66]c[67,67]c[68,68]c[69,69]c[70,70]++c[71,71]c[72,72]c[73,73]c[74,74]++c[75,75]c[76,76]c[77,77]c[78,78]c[79,79]c[80,80]++c[81,81]c[82,82]c[83,83]c[84,84]++c[85,85]c[86,86]c[87,87]c[88,88]c[89,89]c[90,90]++c[91,91]c[92,92]c[93,93]c[94,94]++c[95,95]c[96,96]c[97,97]c[98,98]c[99,99]c[100,100]++c[101,101]c[102,102]c[103,103]c[104,104]++c[105,105]c[106,106]c[107,107]c[108,108]c[109,109]c[110,110]++c[111,111]c[112,112]c[113,113]c[114,114]++c[115,115]c[116,116]c[117,117]', 'description' => ''),
            array('name' => 'Aula C', 'capacity' => 117, 'arrangement' => 'c[1,1]c[2,2]c[3,3]c[4,4]c[5,5]c[6,6]++_++c[7,7]c[8,8]c[9,9]c[10,10]c[11,11]c[12,12]++c[13,13]c[14,14]c[15,15]c[16,16]c[17,17]c[18,18]++c[19,19]c[20,20]c[21,21]c[22,22]c[23,23]c[24,24]++_++c[25,25]c[26,26]c[27,27]c[28,28]c[29,29]c[30,30]++c[31,31]c[32,32]c[33,33]c[34,34]++c[35,35]c[36,36]c[37,37]c[38,38]c[39,39]c[40,40]++c[41,41]c[42,42]c[43,43]c[44,44]++c[45,45]c[46,46]c[47,47]c[48,48]c[49,49]c[50,50]++c[51,51]c[52,52]c[53,53]c[54,54]++c[55,55]c[56,56]c[57,57]c[58,58]c[59,59]c[60,60]++c[61,61]c[62,62]c[63,63]c[64,64]++c[65,65]c[66,66]c[67,67]c[68,68]c[69,69]c[70,70]++c[71,71]c[72,72]c[73,73]c[74,74]++c[75,75]c[76,76]c[77,77]c[78,78]c[79,79]c[80,80]++c[81,81]c[82,82]c[83,83]c[84,84]++c[85,85]c[86,86]c[87,87]c[88,88]c[89,89]c[90,90]++c[91,91]c[92,92]c[93,93]c[94,94]++c[95,95]c[96,96]c[97,97]c[98,98]c[99,99]c[100,100]++c[101,101]c[102,102]c[103,103]c[104,104]++c[105,105]c[106,106]c[107,107]c[108,108]c[109,109]c[110,110]++c[111,111]c[112,112]c[113,113]c[114,114]++c[115,115]c[116,116]c[117,117]', 'description' => ''),
            array('name' => 'B1-06', 'capacity' => 4, 'arrangement' => 'c[1,1]c[2,2]c[3,3]c[4,4]', 'description' => ''),
            array('name' => 'B1-07/08', 'capacity' => 16, 'arrangement' => 'c[1,1]c[2,2]c[3,3]c[4,4]c[5,5]c[6,6]++_++c[7,7]c[8,8]c[9,9]c[10,10]c[11,11]c[12,12]++c[13,13]c[14,14]c[15,15]c[16,16]', 'description' => ''),
            array('name' => 'B1-37', 'capacity' => 18, 'arrangement' => 'c[1,1]c[2,2]c[3,3]c[4,4]c[5,5]c[6,6]++_++c[7,7]c[8,8]c[9,9]c[10,10]c[11,11]c[12,12]++c[13,13]c[14,14]c[15,15]c[16,16]c[17,17]c[18,18]', 'description' => ''),
            array('name' => 'B1-38', 'capacity' => 12, 'arrangement' => 'c[1,1]c[2,2]c[3,3]c[4,4]c[5,5]c[6,6]++_++c[7,7]c[8,8]c[9,9]c[10,10]++c[11,11]c[12,12]', 'description' => ''),
            array('name' => 'B2-08/09', 'capacity' => 16, 'arrangement' => 'c[1,1]c[2,2]c[3,3]c[4,4]c[5,5]c[6,6]++_++c[7,7]c[8,8]c[9,9]c[10,10]c[11,11]c[12,12]++c[13,13]c[14,14]c[15,15]c[16,16]', 'description' => ''),
            array('name' => 'B2-38', 'capacity' => 15, 'arrangement' => 'c[1,1]c[2,2]c[3,3]c[4,4]c[5,5]c[6,6]++_++c[7,7]c[8,8]c[9,9]c[10,10]c[11,11]c[12,12]++c[13,13]c[14,14]c[15,15]', 'description' => ''),
            array('name' => 'B2-39', 'capacity' => 12, 'arrangement' => 'c[1,1]c[2,2]c[3,3]c[4,4]c[5,5]c[6,6]++_++c[7,7]c[8,8]c[9,9]c[10,10]++c[11,11]c[12,12]', 'description' => ''),
            array('name' => 'B2-44', 'capacity' => 4, 'arrangement' => 'c[1,1]c[2,2]c[3,3]c[4,4]', 'description' => ''),
            array('name' => 'B3-08/09', 'capacity' => 16, 'arrangement' => 'c[1,1]c[2,2]c[3,3]c[4,4]c[5,5]c[6,6]++_++c[7,7]c[8,8]c[9,9]c[10,10]c[11,11]c[12,12]++c[13,13]c[14,14]c[15,15]c[16,16]', 'description' => ''),
            array('name' => 'B3-38', 'capacity' => 18, 'arrangement' => 'c[1,1]c[2,2]c[3,3]c[4,4]c[5,5]c[6,6]++_++c[7,7]c[8,8]c[9,9]c[10,10]c[11,11]c[12,12]++c[13,13]c[14,14]c[15,15]c[16,16]c[17,17]c[18,18]', 'description' => ''),
            array('name' => 'B3-39', 'capacity' => 18, 'arrangement' => 'c[1,1]c[2,2]c[3,3]c[4,4]c[5,5]c[6,6]++_++c[7,7]c[8,8]c[9,9]c[10,10]c[11,11]c[12,12]++c[13,13]c[14,14]c[15,15]c[16,16]c[17,17]c[18,18]', 'description' => ''),
            array('name' => 'B3-49', 'capacity' => 12, 'arrangement' => 'c[1,1]c[2,2]c[3,3]c[4,4]c[5,5]c[6,6]++_++c[7,7]c[8,8]c[9,9]c[10,10]++c[11,11]c[12,12]', 'description' => ''),
            array('name' => 'C2-3', 'capacity' => 1, 'arrangement' => 'c[1,1]', 'description' => ''),
            array('name' => 'D-1', 'capacity' => 22, 'arrangement' => 'c[1,1]__c[5,5]__c[6,6]++c[2,2]_c[3,3]___c[7,7]_c[8,8]++c[4,4]_____c[9,9]++_++___c[10,10]___++___c[11,11]_c[12,12]___++___c[13,13]___++_++c[14,14]_____c[19,19]++c[15,15]_c[16,16]___c[20,20]_c[21,21]++c[17,17]__c[18,18]__c[22,22]', 'description' => ''),
            array('name' => 'D-2', 'capacity' => 21, 'arrangement' => 'c[1,1]__c[5,5]__c[6,6]++c[2,2]c[3,3]____c[7,7]c[8,8]++c[4,4]_____c[9,9]++_++___c[10,10]___++___c[11,11]c[12,12]___++___c[13,13]___++_++c[14,14]_____c[19,19]++c[15,15]c[16,16]____c[20,20]c[21,21]++c[17,17]__c[18,18]__c[22,22]', 'description' => ''),
            array('name' => 'D-3', 'capacity' => 22, 'arrangement' => 'c[1,1]__c[5,5]__c[6,6]++c[2,2]_c[3,3]___c[7,7]_c[8,8]++c[4,4]_____c[9,9]++_++___c[10,10]___++___c[11,11]_c[12,12]___++___c[13,13]___++_++c[14,14]_____c[19,19]++c[15,15]_c[16,16]___c[20,20]_c[21,21]++c[17,17]__c[18,18]__c[22,22]', 'description' => ''),
            array('name' => 'Klub Profesorski', 'capacity' => 30, 'arrangement' => 'c[1,1]c[2,2]c[3,3]c[4,4]c[5,5]c[6,6]++_++c[7,7]c[8,8]c[9,9]c[10,10]c[11,11]c[12,12]++c[13,13]c[14,14]c[15,15]c[16,16]c[17,17]c[18,18]++c[19,19]c[20,20]c[21,21]c[22,22]c[23,23]c[24,24]++_++c[25,25]c[26,26]c[27,27]c[28,28]c[29,29]c[30,30]', 'description' => ''),
            array('name' => 'Inna sala', 'capacity' => 30, 'arrangement' =>
                'c[1,1]c[2,2]c[3,3]c[4,4]c[5,5]c[6,6]++_++c[7,7]c[8,8]c[9,9]c[10,10]c[11,11]c[12,12]++c[13,13]c[14,14]c[15,15]c[16,16]c[17,17]c[18,18]++c[19,19]c[20,20]c[21,21]c[22,22]c[23,23]c[24,24]++_++c[25,25]c[26,26]c[27,27]c[28,28]c[29,29]c[30,30]', 'description' => ''
            )
        ];
        foreach ($rooms as $room) {
            DB::table('rooms')->insert([
                'name' => $room['name'],
                'capacity' => $room['capacity'],
                'arrangement' => $room['arrangement'],
                'description' => $room['description']
            ]);
        }
    }
}
