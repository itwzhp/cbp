<script setup>
import {ref} from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import NavElement from '@/Components/NavElement.vue';
import NavButton from '@/Components/NavButton.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import SearchSlideOver from '@/Components/Materials/SearchSlideOver.vue';
import Footer from '@/Layouts/Footer.vue';
import {useSearchStore} from '@/store/search.store';
import {Link} from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
const store = useSearchStore();
const displaySearchDialog = (responsiveNavigationAction) => {
    if (responsiveNavigationAction) {
        showingNavigationDropdown.value = false;
        setTimeout(() => {
            store.displayDialog();
        }, 300);
    } else {
        store.displayDialog();
    }
};
const headline = ref(null);
</script>

<template>
  <div>
    <div class="bg-gradient-to-b from-white-300 via-white-200 to-white-100">
      <div ref="headline">
        <nav class="print:hidden absolute sm:static w-full z-10 bg-white">
          <!-- Primary Navigation Menu -->
          <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Primary Navigation Menu -->
            <div
              class="flex items-center justify-between border-gray-100 py-3 md:space-x-10"
            >
              <div style="min-width: 100px" />
              <div class="hidden md:flex mb-5">
                <ApplicationLogo />
              </div>
              <div class="hidden md:block">
                <NavElement>
                  <span
                    class="cursor-pointer"
                    @click="displaySearchDialog()"
                  >
                    <font-awesome-icon icon="fa-solid fa-magnifying-glass" />
                    Wyszukaj
                  </span>
                </NavElement>
                <NavElement>
                  <Dropdown
                    v-if="$page.props.auth.user"
                    align="right"
                    width="48"
                  >
                    <template #trigger>
                      <span class="inline-flex rounded-md">
                        <button
                          type="button"
                          class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                        >
                          {{ $page.props.auth.user.name }}
                          <svg
                            class="ml-2 -mr-0.5 h-4 w-4"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                          >
                            <path
                              fill-rule="evenodd"
                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                              clip-rule="evenodd"
                            />
                          </svg>
                        </button>
                      </span>
                    </template>
                    <template #content>
                      <DropdownLink
                        v-if="$page.props.auth.user"
                        :href="route('admin.dashboard')"
                      >
                        Panel administracyjny
                      </DropdownLink>
                      <DropdownLink
                        :href="route('logout')"
                        method="post"
                        as="button"
                      >
                        Wyloguj
                      </DropdownLink>
                    </template>
                  </Dropdown>
                  <Link
                    v-if="!$page.props.auth.user"
                    :href="route('login')"
                  >
                    Zaloguj się
                  </Link>
                </NavElement>
              </div>
              <!-- Hamburger -->
              <div class="-mr-2 flex items-center md:hidden">
                <button
                  class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                  @click="showingNavigationDropdown = !showingNavigationDropdown"
                >
                  <svg
                    class="h-6 w-6"
                    stroke="currentColor"
                    fill="none"
                    viewBox="0 0 24 24"
                  >
                    <path
                      :class="{
                        hidden: showingNavigationDropdown,
                        'inline-flex': !showingNavigationDropdown,
                      }"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"
                    />
                    <path
                      :class="{
                        hidden: !showingNavigationDropdown,
                        'inline-flex': showingNavigationDropdown,
                      }"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M6 18L18 6M6 6l12 12"
                    />
                  </svg>
                </button>
              </div>
            </div>
          </div>

          <!-- Responsive Navigation Menu -->
          <div
            :class="{
              block: showingNavigationDropdown,
              hidden: !showingNavigationDropdown,
            }"
            class="md:hidden"
          >
            <div class="pt-2 pb-3 space-y-1">
              <div class="flex justify-center">
                <ApplicationLogo />
              </div>
              <ResponsiveNavLink
                v-if="!$page.props.auth.user"
                :href="route('login')"
              >
                Zaloguj
              </ResponsiveNavLink>
              <ResponsiveNavLink
                class="bg-cbp-100/10"
                :href="route('materials.index')"
              >
                Najnowsze
              </ResponsiveNavLink>
              <ResponsiveNavLink
                class="bg-cbp-100/10"
                @click="displaySearchDialog(true)"
              >
                <font-awesome-icon icon="fa-solid fa-magnifying-glass" />
                Wyszukaj
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('about')"
                :active="route().current('about')"
              >
                O CBP
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :block="true"
              >
                Harcerski System Wychowawczy
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('materials.tags', 'harcerski-system-wychowawczy,zasady-harcerskiego-wychowania,cechy-metody-harcerskiej')"
              >
                &emsp;O HSW
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('materials.tags', 'praca-z-metodykami')"
                :active="route().current('materials.index')"
              >
                &emsp;Grupy Wiekowe
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('materials.tags', 'system-malych-grup')"
                :active="
                  route().current('materials.tag', { tag: '2-konspekt-ksztalceniowy' })
                "
              >
                &emsp;System Małych Grup
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('materials.tags', 'prawa-przyrzeczenie-i-obietnica')"
                :active="route().current('materials.tag', { tag: '2-program' })"
              >
                &emsp;Prawa, Przyrzeczenie i Obietnica
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('materials.tags', 'sluzba')"
                :active="
                  route().current('materials.tag', { tag: '2-propozycja-programowa' })
                "
              >
                &emsp;Służba
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('materials.tags', 'system-instrumentow-metodycznych')"
                :active="route().current('materials.tag', { tag: '2-poradnik' })"
              >
                &emsp;System Instrumentów Metodycznych
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('materials.tags', 'uczenie-w-dzialaniu')"
                :active="route().current('materials.tag', { tag: '2-poradnik' })"
              >
                &emsp;Uczenie w działaniu
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('materials.tags', 'osobisty-przyklad-instruktora')"
                :active="route().current('materials.tag', { tag: '2-poradnik' })"
              >
                &emsp;Osobisty Przykład Instruktora
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('materials.tags', 'obrzedowosc-i-symbolika')"
                :active="route().current('materials.tag', { tag: '2-poradnik' })"
              >
                &emsp;Obrzędowość i Symbolika
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('materials.tags', 'planowanie-w-druzynie,funkcjonowanie-druzyn')"
                :active="route().current('materials.tag', { tag: '2-poradnik' })"
              >
                &emsp;Planowanie wychowawcze
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :block="true"
                :active="route().current('materials.tag', { tag: '2-poradnik' })"
              >
                Wyzwania Wychowawcze
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('materials.tags', 'rozwoj-psychofizyczny-dzieci-i-mlodziezy,praca-nad-emocjami,rozwoj-fizyczny')"
                :active="route().current('materials.tag', { tag: '2-poradnik' })"
              >
                &emsp;Rozwój psychofizyczny
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('materials.tags', 'wyzwania-i-trudnosci-wychowawcze,pandemia,wojna,praca-nad-emocjami')"
                :active="route().current('materials.tag', { tag: '2-poradnik' })"
              >
                &emsp;Społeczne sytuacje kryzysowe
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('materials.tags', 'harcerz-i-natura')"
                :active="route().current('materials.tag', { tag: '2-poradnik' })"
              >
                &emsp;W otoczeniu przyrody
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('materials.tags', 'wychowanie-druchowe-i-religijne')"
                :active="route().current('materials.tag', { tag: '2-poradnik' })"
              >
                &emsp;Wychowanie duchowe i religijne
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('materials.tags', 'wychowanie-ekonomiczne')"
                :active="route().current('materials.tag', { tag: '2-poradnik' })"
              >
                &emsp;Wychowanie ekonomiczne
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('materials.tags', 'wychowanie-patriotyczne')"
                :active="route().current('materials.tag', { tag: '2-poradnik' })"
              >
                &emsp;Wychowanie patriotyczne
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :block="true"
              >
                Szerokie Horyzonty
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('materials.tags', 'techniki,majsterka-zuchowa')"
                :active="route().current('materials.tag', { tag: '2-poradnik' })"
              >
                &emsp;Specjalności
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('materials.tags', 'wychowanie-wodne')"
                :active="route().current('materials.tag', { tag: '2-poradnik' })"
              >
                &emsp;Aktywności wodne
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('materials.tags', 'pierwsza-pomoc')"
                :active="route().current('materials.tag', { tag: '2-poradnik' })"
              >
                &emsp;Pierwsza pomoc
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('materials.tags', 'zdrowie')"
                :active="route().current('materials.tag', { tag: '2-poradnik' })"
              >
                &emsp;Zdrowie
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('materials.tags', 'edukacja-globalna,wiedza-o-swiecie')"
                :active="route().current('materials.tag', { tag: '2-poradnik' })"
              >
                &emsp;Edukacja globalna
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('materials.tags', 'materialy-skautowe-i-zagraniczne')"
                :active="route().current('materials.tag', { tag: '2-poradnik' })"
              >
                &emsp;Skauting
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :block="true"
              >
                Zorganizowane Drużyny
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('materials.tags', 'bezpieczenstwo')"
                :active="route().current('materials.tag', { tag: '2-poradnik' })"
              >
                &emsp;Bezpieczeństwo
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('materials.tags', 'aspekty-prawne-dryzyny')"
                :active="route().current('materials.tag', { tag: '2-poradnik' })"
              >
                &emsp;Aspekty prawne
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('materials.tags', 'nabor-i-promocja-druzyny')"
                :active="route().current('materials.tag', { tag: '2-poradnik' })"
              >
                &emsp;Nabór i promocja
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('materials.tags', 'sojusznicy')"
                :active="route().current('materials.tag', { tag: '2-poradnik' })"
              >
                &emsp;Sojusznicy
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('materials.tags', 'dokumentacja')"
                :active="route().current('materials.tag', { tag: '2-poradnik' })"
              >
                &emsp;Dokumentacja
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :block="true
                "
              >
                Praca z kadrą
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('materials.tags', 'druzynowy,komendant-i-komenda-szczepu')"
                :active="route().current('materials.tag', { tag: '2-poradnik' })"
              >
                &emsp;W drużynie i szczepie
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('materials.tags', 'komendant-hufca,osoba-od-pracy-z-kadra-w-choragwi,metodykprogramowiec-hufca,namiestnik-hufca,ksztalceniowiec-hufca,namiestnik-hufca')"
                :active="route().current('materials.tag', { tag: '2-poradnik' })"
              >
                &emsp;W hufcu
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('materials.tags', 'komendant-choragwi,osoba-od-pracy-z-kadra-w-choragwi,metodykprogramowiec-choragwi,czlonek-referatu,ksztalceniowiec-choragwi,ksi-choragwi')"
                :active="route().current('materials.tag', { tag: '2-poradnik' })"
              >
                &emsp;W chorągwi
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('materials.tags', 'kwatermistrzobsluga-baz,finanse,organizacjabiuro,promocja,ruch-przyjaciol-harcerstwa')"
                :active="route().current('materials.tag', { tag: '2-poradnik' })"
              >
                &emsp;Kadra wspierająca
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('materials.tags', 'kurs-przewodnikowski,kurs-podharcmistrzowski,kurs-harcmistrzowski')"
                :active="route().current('materials.tag', { tag: '2-poradnik' })"
              >
                &emsp;Formy kształceniowe
              </ResponsiveNavLink>
            </div>

            <!-- Responsive Settings Options -->
            <div
              v-if="$page.props.auth.user"
              class="pt-4 pb-1 border-t border-gray-200"
            >
              <div class="px-4">
                <div class="font-medium text-base text-gray-800">
                  {{ $page.props.auth.user.name }}
                </div>
                <div class="font-medium text-sm text-gray-500">
                  {{ $page.props.auth.user.email }}
                </div>
              </div>

              <div class="mt-3 space-y-1">
                <ResponsiveNavLink
                  :href="route('admin.dashboard')"
                >
                  Panel administracyjny
                </ResponsiveNavLink>
              </div>
              <div class="mt-3 space-y-1">
                <ResponsiveNavLink
                  :href="route('logout')"
                  method="post"
                  as="button"
                >
                  Wyloguj
                </ResponsiveNavLink>
                <hr>
              </div>
            </div>
          </div>
        </nav>
        <nav class="print:hidden">
          <div class="max-w-7xl max-h-22 xl:max-h-16 mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-center max-h-22 xl:h-16">
              <div class="flex">
                <!-- Navigation Links -->
                <div class="max-h-22 xl:max-h-16 hidden space-x-8 sm:-my-px sm:flex">
                  <NavLink
                    :href="route('about')"
                    :active="route().current('about')"
                  >
                    O CBP
                  </NavLink>
                  <Dropdown width="48">
                    <template #trigger>
                      <NavButton>
                        Harcerski System Wychowawczy
                      </NavButton>
                    </template>
                    <template #content>
                      <ResponsiveNavLink
                        :href="route('materials.tags', 'harcerski-system-wychowawczy,zasady-harcerskiego-wychowania,cechy-metody-harcerskiej')"
                        :active="
                          route().current('materials.tags', {
                            tags: 'harcerski-system-wychowawczy%2Czasady-harcerskiego-wychowania%2Ccechy-metody-harcerskiej',
                          })
                        "
                      >
                        O HSW
                      </ResponsiveNavLink>
                      <ResponsiveNavLink
                        :href="route('materials.tags', 'praca-z-metodykami')"
                        :active="
                          route().current('materials.tags', {
                            tags: 'praca-z-metodykami',
                          })
                        "
                      >
                        Grupy Wiekowe
                      </ResponsiveNavLink>
                      <ResponsiveNavLink
                        :href="route('materials.tags', 'system-malych-grup')"
                        :active="
                          route().current('materials.tags', {
                            tags: 'system-malych-grup',
                          })
                        "
                      >
                        System Małych Grup
                      </ResponsiveNavLink>
                      <ResponsiveNavLink
                        :href="route('materials.tags', 'prawa-przyrzeczenie-i-obietnica')"
                        :active="
                          route().current('materials.tags', {
                            tags: 'prawa-przyrzeczenie-i-obietnica',
                          })
                        "
                      >
                        Prawa, Przyrzeczenie i Obietnica
                      </ResponsiveNavLink>
                      <ResponsiveNavLink
                        :href="route('materials.tags', 'sluzba')"
                        :active="
                          route().current('materials.tags', {
                            tags: 'sluzba',
                          })
                        "
                      >
                        Służba
                      </ResponsiveNavLink>
                      <ResponsiveNavLink
                        :href="route('materials.tags', 'system-instrumentow-metodycznych')"
                        :active="
                          route().current('materials.tags', {
                            tags: 'system-instrumentow-metodycznych',
                          })
                        "
                      >
                        System Instrumentów Metodycznych
                      </ResponsiveNavLink>
                      <ResponsiveNavLink
                        :href="route('materials.tags', 'uczenie-w-dzialaniu')"
                        :active="
                          route().current('materials.tags', {
                            tags: 'uczenie-w-dzialaniu',
                          })
                        "
                      >
                        Uczenie w działaniu
                      </ResponsiveNavLink>
                      <ResponsiveNavLink
                        :href="route('materials.tags', 'osobisty-przyklad-instruktora')"
                        :active="
                          route().current('materials.tags', {
                            tags: 'osobisty-przyklad-instruktora',
                          })
                        "
                      >
                        Osobisty Przykład Instruktora
                      </ResponsiveNavLink>
                      <ResponsiveNavLink
                        :href="route('materials.tags', 'obrzedowosc-i-symbolika')"
                        :active="
                          route().current('materials.tags', {
                            tags: 'obrzedowosc-i-symbolika',
                          })
                        "
                      >
                        Obrzędowość i Symbolika
                      </ResponsiveNavLink>
                      <ResponsiveNavLink
                        :href="route('materials.tags', 'planowanie-w-druzynie,funkcjonowanie-druzyn')"
                        :active="
                          route().current('materials.tags', {
                            tags: 'planowanie-w-druzynie%2Cfunkcjonowanie-druzyn',
                          })
                        "
                      >
                        Planowanie wychowawcze
                      </ResponsiveNavLink>
                    </template>
                  </Dropdown>
                  <Dropdown width="48">
                    <template #trigger>
                      <NavButton
                        :active="
                          route().current('materials.tag', {
                            tag: '2-konspekt-ksztalceniowy',
                          }) ||
                            route().current('materials.tag', {
                              tag: '2-konspekt-programowy',
                            })
                        "
                      >
                        Wyzwania wychowawcze
                      </NavButton>
                    </template>
                    <template #content>
                      <ResponsiveNavLink
                        :href="route('materials.tags', 'rozwoj-psychofizyczny-dzieci-i-mlodziezy,praca-nad-emocjami,rozwoj-fizyczny')"
                        :active="
                          route().current('materials.tags', {
                            tags: 'rozwoj-psychofizyczny-dzieci-i-mlodziezy%2Cpraca-nad-emocjami%2Crozwoj-fizyczny',
                          })
                        "
                      >
                        Rozwój psychofizyczny
                      </ResponsiveNavLink>
                      <ResponsiveNavLink
                        :href="route('materials.tags', 'wyzwania-i-trudnosci-wychowawcze,pandemia,wojna,praca-nad-emocjami')"
                        :active="
                          route().current('materials.tags', {
                            tags: 'wyzwania-i-trudnosci-wychowawcze%2Cpandemia%2Cwojna%2Cpraca-nad-emocjami',
                          })
                        "
                      >
                        Społeczne sytuacje kryzysowe
                      </ResponsiveNavLink>
                      <ResponsiveNavLink
                        :href="route('materials.tags', 'harcerz-i-natura')"
                        :active="
                          route().current('materials.tags', {
                            tags: 'harcerz-i-natura',
                          })
                        "
                      >
                        W otoczeniu przyrody
                      </ResponsiveNavLink>
                      <ResponsiveNavLink
                        :href="route('materials.tags', 'wychowanie-druchowe-i-religijne')"
                        :active="
                          route().current('materials.tags', {
                            tags: 'wychowanie-druchowe-i-religijne',
                          })
                        "
                      >
                        Wychowanie druchowe i religijne
                      </ResponsiveNavLink>
                      <ResponsiveNavLink
                        :href="route('materials.tags', 'wychowanie-ekonomiczne')"
                        :active="
                          route().current('materials.tags', {
                            tags: 'wychowanie-ekonomiczne',
                          })
                        "
                      >
                        Wychowanie ekonomiczne
                      </ResponsiveNavLink>
                      <ResponsiveNavLink
                        :href="route('materials.tags', 'wychowanie-patriotyczne')"
                        :active="
                          route().current('materials.tags', {
                            tags: 'wychowanie-patriotyczne',
                          })
                        "
                      >
                        Wychowanie Patriotyczne
                      </ResponsiveNavLink>
                    </template>
                  </Dropdown>
                  <Dropdown>
                    <template #trigger>
                      <NavButton>
                        Szerokie horyzonty
                      </NavButton>
                    </template>
                    <template #content>
                      <ResponsiveNavLink
                        :href="route('materials.tags', 'techniki,majsterka-zuchowa')"
                        :active="
                          route().current('materials.tags', {
                            tags: 'techniki%2Cmajsterka-zuchowa'
                          })
                        "
                      >
                        Specjalności
                      </ResponsiveNavLink>
                      <ResponsiveNavLink
                        :href="route('materials.tags', 'wychowanie-wodne')"
                        :active="
                          route().current('materials.tags', {
                            tags: 'wychowanie-wodne'
                          })
                        "
                      >
                        Aktywności wodne
                      </ResponsiveNavLink>
                      <ResponsiveNavLink
                        :href="route('materials.tags', 'pierwsza-pomoc')"
                        :active="
                          route().current('materials.tags', {
                            tags: 'pierwsza-pomoc'
                          })
                        "
                      >
                        Pierwsza Pomoc
                      </ResponsiveNavLink>
                      <ResponsiveNavLink
                        :href="route('materials.tags', 'zdrowie')"
                        :active="
                          route().current('materials.tags', {
                            tags: 'zdrowie'
                          })
                        "
                      >
                        Zdrowie
                      </ResponsiveNavLink>
                      <ResponsiveNavLink
                        :href="route('materials.tags', 'edukacja-globalna,wiedza-o-swiecie')"
                        :active="
                          route().current('materials.tags', {
                            tags: 'edukacja-globalna%2Cwiedza-o-swiecie'
                          })
                        "
                      >
                        Edukacja globalna
                      </ResponsiveNavLink>
                      <ResponsiveNavLink
                        :href="route('materials.tags', 'materialy-skautowe-i-zagraniczne')"
                        :active="
                          route().current('materials.tags', {
                            tags: 'materialy-skautowe-i-zagraniczne'
                          })
                        "
                      >
                        Skauting
                      </ResponsiveNavLink>
                    </template>
                  </Dropdown>
                  <Dropdown>
                    <template #trigger>
                      <NavButton>
                        Zorganizowane Drużyny
                      </NavButton>
                    </template>
                    <template #content>
                      <ResponsiveNavLink
                        :href="route('materials.tags', 'bezpieczenstwo')"
                        :active="
                          route().current('materials.tags', {
                            tags: 'bezpieczenstwo'
                          })
                        "
                      >
                        Bezpieczeństwo
                      </ResponsiveNavLink>
                      <ResponsiveNavLink
                        :href="route('materials.tags', 'aspekty-prawne-dryzyny')"
                        :active="
                          route().current('materials.tags', {
                            tags: 'aspekty-prawne-dryzyny'
                          })
                        "
                      >
                        Aspekty Prawne
                      </ResponsiveNavLink>
                      <ResponsiveNavLink
                        :href="route('materials.tags', 'nabor-i-promocja-druzyny')"
                        :active="
                          route().current('materials.tags', {
                            tags: 'nabor-i-promocja-druzyny'
                          })
                        "
                      >
                        Nabór i promocja
                      </ResponsiveNavLink>
                      <ResponsiveNavLink
                        :href="route('materials.tags', 'sojusznicy')"
                        :active="
                          route().current('materials.tags', {
                            tags: 'sojusznicy'
                          })
                        "
                      >
                        Sojusznicy
                      </ResponsiveNavLink>
                      <ResponsiveNavLink
                        :href="route('materials.tags', 'dokumentacja')"
                        :active="
                          route().current('materials.tags', {
                            tags: 'dokumentacja'
                          })
                        "
                      >
                        Dokumentacja
                      </ResponsiveNavLink>
                    </template>
                  </Dropdown>
                  <Dropdown>
                    <template #trigger>
                      <NavButton>
                        Praca z kadrą
                      </NavButton>
                    </template>
                    <template #content>
                      <ResponsiveNavLink
                        :href="route('materials.tags', 'druzynowy,komendant-i-komenda-szczepu')"
                        :active="
                          route().current('materials.tags', {
                            tags: 'druzynowy%2Ckomendant-i-komenda-szczepu'
                          })
                        "
                      >
                        W drużynie i szczepie
                      </ResponsiveNavLink>
                      <ResponsiveNavLink
                        :href="route('materials.tags', 'komendant-hufca,osoba-od-pracy-z-kadra-w-choragwi,metodykprogramowiec-hufca,namiestnik-hufca,ksztalceniowiec-hufca,namiestnik-hufca')"
                        :active="
                          route().current('materials.tags', {
                            tags: 'komendant-hufca%2Cosoba-od-pracy-z-kadra-w-choragwi%2Cmetodykprogramowiec-hufca%2Cnamiestnik-hufca%2Cksztalceniowiec-hufca%2Cnamiestnik-hufca'
                          })
                        "
                      >
                        W hufcu
                      </ResponsiveNavLink>
                      <ResponsiveNavLink
                        :href="route('materials.tags', 'komendant-choragwi,osoba-od-pracy-z-kadra-w-choragwi,metodykprogramowiec-choragwi,czlonek-referatu,ksztalceniowiec-choragwi,ksi-choragwi')"
                        :active="
                          route().current('materials.tags', {
                            tags: 'komendant-choragwi%2Cosoba-od-pracy-z-kadra-w-choragwi%2Cmetodykprogramowiec-choragwi%2Cczlonek-referatu%2Cksztalceniowiec-choragwi%2Cksi-choragwi'
                          })
                        "
                      >
                        W chorągwi
                      </ResponsiveNavLink>
                      <ResponsiveNavLink
                        :href="route('materials.tags', 'kwatermistrzobsluga-baz,finanse,organizacjabiuro,promocja,ruch-przyjaciol-harcerstwa')"
                        :active="
                          route().current('materials.tags', {
                            tags: 'kwatermistrzobsluga-baz%2Cfinanse%2Corganizacjabiuro%2Cpromocja%2Cruch-przyjaciol-harcerstwa'
                          })
                        "
                      >
                        Kadra wspierająca
                      </ResponsiveNavLink>
                      <ResponsiveNavLink
                        :href="route('materials.tags', 'kurs-przewodnikowski,kurs-podharcmistrzowski,kurs-harcmistrzowski')"
                        :active="
                          route().current('materials.tags', {
                            tags: 'kurs-przewodnikowski%2Ckurs-podharcmistrzowski%2Ckurs-harcmistrzowski'
                          })
                        "
                      >
                        Formy kształceniowe
                      </ResponsiveNavLink>
                    </template>
                  </Dropdown>
                  <NavLink
                    :href="route('materials.index')"
                  >
                    <!--                    <span class="border-2 border-cbp-100 rounded-xl p-3">-->
                    <i class="fa-brands fa-pagelines text-cbp-300 mr-2" />
                    Najnowsze materiały
                    <!--                    </span>-->
                  </NavLink>
                </div>
              </div>
            </div>
          </div>
        </nav>

        <div v-if="$page.props.flash && $page.props.flash.message">
          <div
            class="p-3 my-5 bg-gray-200 max-w-7xl mx-auto"
            :class="$page.props.flash.message.class"
          >
            {{ $page.props.flash.message }}
          </div>
        </div>

        <!-- Page Heading -->
        <header
          v-if="$slots.header"
          class="bg-white shadow"
        >
          <div class="max-w-7xl mx-auto py-2 px-4 sm:px-6 lg:px-8 print:px-1 print:py-1">
            <slot name="header" />
          </div>
        </header>
      </div>

      <!-- Page Content -->
      <main
        id="main-content"
        class="main-content"
      >
        <slot />
        <Footer />
      </main>
    </div>
  </div>
  <SearchSlideOver />
</template>
<style scoped>
@media print {
    .main-content {
        height: auto !important;
    }
}
</style>
