<?php
    include("../seguranca/seguranca.php");
    protegePagina(1);
    require_once('../php/class.php');
    require_once('../bd_funcao/maysql.php');
    require_once('../php/funcao_0.2.php');
?>

<?php
if($idetapa = (isset($_GET['kj'])) ? dcript($_GET['kj'],'Erro no recebimento do id') : NULL){
	$consulta = new consulta();
                $consulta->campo	= 'a.id, b.nome, c.nome, d.nome, c.data_etapa, c.local, b.anilha, b.id_modalidade, c.id_temporada, d.id_clube, a.numero';
                $consulta->tabela	= "arpag_passaro_etapa AS a INNER JOIN arpag_passaro    AS b ON b.id = a.id_passaro
                                                                INNER JOIN arpag_etapa      AS c ON c.id = a.id_etapa
                                                                INNER JOIN arpag_pessoa     AS d ON d.id = a.id_pessoa";
                $consulta->parametro= "a.id = ".$idetapa;
				$executa = select_db($consulta);
				$linha = $executa->fetch_array();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ficha</title>
<style type="text/css">
	body{margin:0; padding:0;}
	table{font-family:Arial, Helvetica, sans-serif; font-size:12px;}
</style>
</head>

<body onload="window.print();">
<table width="837" border="1">
  <tr>
    <td colspan="3" style="text-align:center; font-weight:bold;">Ficha de Inscrição / Central de Torneios</td>
  </tr>
  <tr>
    <td width="100"><img src="../images/logotipo.jpg" width="100" height="95" /></td>
    <td width="519" style="font-weight:bold;">Data do Etapa: <?php echo dtahoraela($linha['data_etapa']);?><br />
      Evento: <?php echo utf8_encode(retorna_nome($linha['id_temporada'],'arpag_temporada'));?><br />
      Etapa: <?php echo utf8_encode($linha[2]);?><br />
      Prova: <?php echo utf8_encode(retorna_nome($linha['id_modalidade'],'arpag_modalidade'));?></td>
    <td width="196" style="font-weight:bold;"><p>Ave: <?php echo $linha[1];?><br />
    </p>
    <p>Estaca: <?php echo $linha['numero'];?></p></td>
  </tr>
  <tr>
    <td style="font-weight:bold;">Ave: </td>
    <td colspan="2"><table width="100%" border="0">
      <tr>
        <td><?php echo utf8_encode($linha[1]);?> </td>
        <td style="font-weight:bold;">Anilha: <?php echo utf8_encode($linha['anilha']);?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td style="font-weight:bold;">Proprietário</td>
    <td colspan="2"><?php echo utf8_encode($linha[3]);?></td>
  </tr>
  <tr>
    <td style="font-weight:bold;">Clube</td>
    <td colspan="2"><?php echo utf8_encode(retorna_nome($linha['id_clube'],'arpag_clube'));?></td>
  </tr>
  <!--<tr>
    <td colspan="3" style="font-weight:bold; color:#F00; text-align:center;">Declaro estar ciente e de acordo com o regulamento da Cobrap.</td>
  </tr>-->
  <tr>
    <td colspan="3" style="font-weight:bold; text-align:center;">Válida somente acompanhada de carimbo do Clube ou Federação.</td>
  </tr>
  <tr>
    <td colspan="2" style="text-align:center !important; font-weight:bold;">MARCAÇÃO CLASSIFICATÓRIA</td>
    <td style="text-align:center !important; font-weight:bold;">VISTO FISCAL</td>
  </tr>
  <tr>
    <td colspan="3"><table border="1" style="text-align:center !important;">
      <tr>
        <td width="24">1</td>
        <td width="24">2</td>
        <td width="24">3</td>
        <td width="24">4</td>
        <td width="24">5</td>
        <td width="24">6</td>
        <td width="24">7</td>
        <td width="24">8</td>
        <td width="24">9</td>
        <td width="24">10</td>
        <td width="24">11</td>
        <td width="24">12</td>
        <td width="24">13</td>
        <td width="24">14</td>
        <td width="24">15</td>
        <td width="24">16</td>
        <td width="24">17</td>
        <td width="24">18</td>
        <td width="24">19</td>
        <td width="24">20</td>
        <td rowspan="3" width="230">&nbsp;</td>
        </tr>
      <tr>
        <td>21</td>
        <td>22</td>
        <td>23</td>
        <td>24</td>
        <td>25</td>
        <td>26</td>
        <td>27</td>
        <td>28</td>
        <td>29</td>
        <td>30</td>
        <td>31</td>
        <td>32</td>
        <td>33</td>
        <td>34</td>
        <td>35</td>
        <td>36</td>
        <td>37</td>
        <td>38</td>
        <td>39</td>
        <td>40</td>
        </tr>
      <tr>
        <td>41</td>
        <td>42</td>
        <td>43</td>
        <td>44</td>
        <td>45</td>
        <td>46</td>
        <td>47</td>
        <td>48</td>
        <td>49</td>
        <td>50</td>
        <td>51</td>
        <td>52</td>
        <td>53</td>
        <td>54</td>
        <td>55</td>
        <td>56</td>
        <td>57</td>
        <td>58</td>
        <td>59</td>
        <td>60</td>
        </tr>
      <tr>
        <td>61</td>
        <td>62</td>
        <td>63</td>
        <td>64</td>
        <td>65</td>
        <td>66</td>
        <td>67</td>
        <td>68</td>
        <td>69</td>
        <td>70</td>
        <td>71</td>
        <td>72</td>
        <td>73</td>
        <td>74</td>
        <td>75</td>
        <td>76</td>
        <td>77</td>
        <td>78</td>
        <td>79</td>
        <td>80</td>
        <td rowspan="3">&nbsp;</td>
        </tr>
      <tr>
        <td>81</td>
        <td>82</td>
        <td>83</td>
        <td>84</td>
        <td>85</td>
        <td>86</td>
        <td>87</td>
        <td>88</td>
        <td>89</td>
        <td>90</td>
        <td>91</td>
        <td>92</td>
        <td>93</td>
        <td>94</td>
        <td>95</td>
        <td>96</td>
        <td>97</td>
        <td>98</td>
        <td>99</td>
        <td>100</td>
        </tr>
      <tr>
        <td>101</td>
        <td>102</td>
        <td>103</td>
        <td>104</td>
        <td>105</td>
        <td>106</td>
        <td>107</td>
        <td>108</td>
        <td>109</td>
        <td>110</td>
        <td>111</td>
        <td>112</td>
        <td>113</td>
        <td>114</td>
        <td>115</td>
        <td>116</td>
        <td>117</td>
        <td>118</td>
        <td>119</td>
        <td>120</td>
        </tr>
      <tr>
        <td>121</td>
        <td>122</td>
        <td>123</td>
        <td>124</td>
        <td>125</td>
        <td>126</td>
        <td>127</td>
        <td>128</td>
        <td>129</td>
        <td>130</td>
        <td>131</td>
        <td>132</td>
        <td>133</td>
        <td>134</td>
        <td>135</td>
        <td>136</td>
        <td>137</td>
        <td>138</td>
        <td>139</td>
        <td>140</td>
        <td rowspan="3">&nbsp;</td>
        </tr>
      <tr>
        <td>141</td>
        <td>142</td>
        <td>143</td>
        <td>144</td>
        <td>145</td>
        <td>146</td>
        <td>147</td>
        <td>148</td>
        <td>149</td>
        <td>150</td>
        <td>151</td>
        <td>152</td>
        <td>153</td>
        <td>154</td>
        <td>155</td>
        <td>156</td>
        <td>157</td>
        <td>158</td>
        <td>159</td>
        <td>160</td>
        </tr>
      <tr>
        <td>161</td>
        <td>162</td>
        <td>163</td>
        <td>164</td>
        <td>165</td>
        <td>166</td>
        <td>167</td>
        <td>168</td>
        <td>169</td>
        <td>170</td>
        <td>171</td>
        <td>172</td>
        <td>173</td>
        <td>174</td>
        <td>175</td>
        <td>176</td>
        <td>177</td>
        <td>178</td>
        <td>179</td>
        <td>180</td>
        </tr>
      <tr>
        <td>181</td>
        <td>182</td>
        <td>183</td>
        <td>184</td>
        <td>185</td>
        <td>186</td>
        <td>187</td>
        <td>188</td>
        <td>189</td>
        <td>190</td>
        <td>191</td>
        <td>192</td>
        <td>193</td>
        <td>194</td>
        <td>195</td>
        <td>196</td>
        <td>197</td>
        <td>198</td>
        <td>199</td>
        <td>200</td>
        <td rowspan="3">&nbsp;</td>
        </tr>
      <tr>
        <td>201</td>
        <td>202</td>
        <td>203</td>
        <td>204</td>
        <td>205</td>
        <td>206</td>
        <td>207</td>
        <td>208</td>
        <td>209</td>
        <td>210</td>
        <td>211</td>
        <td>212</td>
        <td>213</td>
        <td>214</td>
        <td>215</td>
        <td>216</td>
        <td>217</td>
        <td>218</td>
        <td>219</td>
        <td>220</td>
        </tr>
      <tr>
        <td>221</td>
        <td>222</td>
        <td>223</td>
        <td>224</td>
        <td>225</td>
        <td>226</td>
        <td>227</td>
        <td>228</td>
        <td>229</td>
        <td>230</td>
        <td>231</td>
        <td>232</td>
        <td>233</td>
        <td>234</td>
        <td>235</td>
        <td>236</td>
        <td>237</td>
        <td>238</td>
        <td>239</td>
        <td>240</td>
        </tr>
      <tr>
        <td>241</td>
        <td>242</td>
        <td>243</td>
        <td>244</td>
        <td>245</td>
        <td>246</td>
        <td>247</td>
        <td>248</td>
        <td>249</td>
        <td>250</td>
        <td>251</td>
        <td>252</td>
        <td>253</td>
        <td>254</td>
        <td>255</td>
        <td>256</td>
        <td>257</td>
        <td>258</td>
        <td>259</td>
        <td>260</td>
        <td rowspan="3">&nbsp;</td>
        </tr>
      <tr>
        <td>261</td>
        <td>262</td>
        <td>263</td>
        <td>264</td>
        <td>265</td>
        <td>266</td>
        <td>267</td>
        <td>268</td>
        <td>269</td>
        <td>270</td>
        <td>271</td>
        <td>272</td>
        <td>273</td>
        <td>274</td>
        <td>275</td>
        <td>276</td>
        <td>277</td>
        <td>278</td>
        <td>279</td>
        <td>280</td>
        </tr>
      <tr>
        <td>281</td>
        <td>282</td>
        <td>283</td>
        <td>284</td>
        <td>285</td>
        <td>286</td>
        <td>287</td>
        <td>288</td>
        <td>289</td>
        <td>290</td>
        <td>291</td>
        <td>292</td>
        <td>293</td>
        <td>294</td>
        <td>295</td>
        <td>296</td>
        <td>297</td>
        <td>298</td>
        <td>299</td>
        <td>300</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" style="text-align:center !important; font-weight:bold;">MARCAÇÃO CLASSIFICATÓRIA</td>
    <td style="text-align:center !important; font-weight:bold;">VISTO FISCAL</td>
  </tr>
  <tr>
    <td colspan="3"><table border="1" style="text-align:center !important;">
      <tr>
        <td width="24">1</td>
        <td width="24">2</td>
        <td width="24">3</td>
        <td width="24">4</td>
        <td width="24">5</td>
        <td width="24">6</td>
        <td width="24">7</td>
        <td width="24">8</td>
        <td width="24">9</td>
        <td width="24">10</td>
        <td width="24">11</td>
        <td width="24">12</td>
        <td width="24">13</td>
        <td width="24">14</td>
        <td width="24">15</td>
        <td width="24">16</td>
        <td width="24">17</td>
        <td width="24">18</td>
        <td width="24">19</td>
        <td width="24">20</td>
        <td rowspan="3" width="230">&nbsp;</td>
      </tr>
      <tr>
        <td>21</td>
        <td>22</td>
        <td>23</td>
        <td>24</td>
        <td>25</td>
        <td>26</td>
        <td>27</td>
        <td>28</td>
        <td>29</td>
        <td>30</td>
        <td>31</td>
        <td>32</td>
        <td>33</td>
        <td>34</td>
        <td>35</td>
        <td>36</td>
        <td>37</td>
        <td>38</td>
        <td>39</td>
        <td>40</td>
      </tr>
      <tr>
        <td>41</td>
        <td>42</td>
        <td>43</td>
        <td>44</td>
        <td>45</td>
        <td>46</td>
        <td>47</td>
        <td>48</td>
        <td>49</td>
        <td>50</td>
        <td>51</td>
        <td>52</td>
        <td>53</td>
        <td>54</td>
        <td>55</td>
        <td>56</td>
        <td>57</td>
        <td>58</td>
        <td>59</td>
        <td>60</td>
      </tr>
      <tr>
        <td>61</td>
        <td>62</td>
        <td>63</td>
        <td>64</td>
        <td>65</td>
        <td>66</td>
        <td>67</td>
        <td>68</td>
        <td>69</td>
        <td>70</td>
        <td>71</td>
        <td>72</td>
        <td>73</td>
        <td>74</td>
        <td>75</td>
        <td>76</td>
        <td>77</td>
        <td>78</td>
        <td>79</td>
        <td>80</td>
        <td rowspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td>81</td>
        <td>82</td>
        <td>83</td>
        <td>84</td>
        <td>85</td>
        <td>86</td>
        <td>87</td>
        <td>88</td>
        <td>89</td>
        <td>90</td>
        <td>91</td>
        <td>92</td>
        <td>93</td>
        <td>94</td>
        <td>95</td>
        <td>96</td>
        <td>97</td>
        <td>98</td>
        <td>99</td>
        <td>100</td>
      </tr>
      <tr>
        <td>101</td>
        <td>102</td>
        <td>103</td>
        <td>104</td>
        <td>105</td>
        <td>106</td>
        <td>107</td>
        <td>108</td>
        <td>109</td>
        <td>110</td>
        <td>111</td>
        <td>112</td>
        <td>113</td>
        <td>114</td>
        <td>115</td>
        <td>116</td>
        <td>117</td>
        <td>118</td>
        <td>119</td>
        <td>120</td>
      </tr>
      <tr>
        <td>121</td>
        <td>122</td>
        <td>123</td>
        <td>124</td>
        <td>125</td>
        <td>126</td>
        <td>127</td>
        <td>128</td>
        <td>129</td>
        <td>130</td>
        <td>131</td>
        <td>132</td>
        <td>133</td>
        <td>134</td>
        <td>135</td>
        <td>136</td>
        <td>137</td>
        <td>138</td>
        <td>139</td>
        <td>140</td>
        <td rowspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td>141</td>
        <td>142</td>
        <td>143</td>
        <td>144</td>
        <td>145</td>
        <td>146</td>
        <td>147</td>
        <td>148</td>
        <td>149</td>
        <td>150</td>
        <td>151</td>
        <td>152</td>
        <td>153</td>
        <td>154</td>
        <td>155</td>
        <td>156</td>
        <td>157</td>
        <td>158</td>
        <td>159</td>
        <td>160</td>
      </tr>
      <tr>
        <td>161</td>
        <td>162</td>
        <td>163</td>
        <td>164</td>
        <td>165</td>
        <td>166</td>
        <td>167</td>
        <td>168</td>
        <td>169</td>
        <td>170</td>
        <td>171</td>
        <td>172</td>
        <td>173</td>
        <td>174</td>
        <td>175</td>
        <td>176</td>
        <td>177</td>
        <td>178</td>
        <td>179</td>
        <td>180</td>
      </tr>
      <tr>
        <td>181</td>
        <td>182</td>
        <td>183</td>
        <td>184</td>
        <td>185</td>
        <td>186</td>
        <td>187</td>
        <td>188</td>
        <td>189</td>
        <td>190</td>
        <td>191</td>
        <td>192</td>
        <td>193</td>
        <td>194</td>
        <td>195</td>
        <td>196</td>
        <td>197</td>
        <td>198</td>
        <td>199</td>
        <td>200</td>
        <td rowspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td>201</td>
        <td>202</td>
        <td>203</td>
        <td>204</td>
        <td>205</td>
        <td>206</td>
        <td>207</td>
        <td>208</td>
        <td>209</td>
        <td>210</td>
        <td>211</td>
        <td>212</td>
        <td>213</td>
        <td>214</td>
        <td>215</td>
        <td>216</td>
        <td>217</td>
        <td>218</td>
        <td>219</td>
        <td>220</td>
      </tr>
      <tr>
        <td>221</td>
        <td>222</td>
        <td>223</td>
        <td>224</td>
        <td>225</td>
        <td>226</td>
        <td>227</td>
        <td>228</td>
        <td>229</td>
        <td>230</td>
        <td>231</td>
        <td>232</td>
        <td>233</td>
        <td>234</td>
        <td>235</td>
        <td>236</td>
        <td>237</td>
        <td>238</td>
        <td>239</td>
        <td>240</td>
      </tr>
      <tr>
        <td>241</td>
        <td>242</td>
        <td>243</td>
        <td>244</td>
        <td>245</td>
        <td>246</td>
        <td>247</td>
        <td>248</td>
        <td>249</td>
        <td>250</td>
        <td>251</td>
        <td>252</td>
        <td>253</td>
        <td>254</td>
        <td>255</td>
        <td>256</td>
        <td>257</td>
        <td>258</td>
        <td>259</td>
        <td>260</td>
        <td rowspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td>261</td>
        <td>262</td>
        <td>263</td>
        <td>264</td>
        <td>265</td>
        <td>266</td>
        <td>267</td>
        <td>268</td>
        <td>269</td>
        <td>270</td>
        <td>271</td>
        <td>272</td>
        <td>273</td>
        <td>274</td>
        <td>275</td>
        <td>276</td>
        <td>277</td>
        <td>278</td>
        <td>279</td>
        <td>280</td>
        </tr>
      <tr>
        <td>281</td>
        <td>282</td>
        <td>283</td>
        <td>284</td>
        <td>285</td>
        <td>286</td>
        <td>287</td>
        <td>288</td>
        <td>289</td>
        <td>290</td>
        <td>291</td>
        <td>292</td>
        <td>293</td>
        <td>294</td>
        <td>295</td>
        <td>296</td>
        <td>297</td>
        <td>298</td>
        <td>299</td>
        <td>300</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" height="145" border="1">
      <tr>
        <td width="75%" height="27" style="text-align:center !important; font-weight:bold;">OBSERVAÇÕES</td>
        <td width="25%" style="text-align:center !important; font-weight:bold;">CARIMBO</td>
      </tr>
      <tr>
        <td height="110" style="text-align:center !important; font-weight:bold;">&nbsp;</td>
        <td style="text-align:center !important; font-weight:bold;">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" style="text-align:center; font-weight:bold;">
    [&nbsp;&nbsp;&nbsp;] Fora Regulamento&nbsp;&nbsp;&nbsp;[&nbsp;&nbsp;&nbsp;]Não Cantou [&nbsp;&nbsp;&nbsp;] Desclassificação [&nbsp;&nbsp;&nbsp;] Não compareceu</td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="34%" height="88" style="text-align:center !important; font-weight:bold;"><p>&nbsp;</p>
          <p>________________________________<br />
          JUIZ</p></td>
        <td width="32%">&nbsp;</td>
        <td width="34%" style="text-align:center !important; font-weight:bold;"><p>&nbsp;</p>
          <p>________________________________<br />
          MESÁRIO</p></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
<?php
  }
?>
