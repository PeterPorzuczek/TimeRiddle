<template>
  <div
    class="content-page
      t-sm:t-p-2 t-sm:t--m-2 t-p-8
      t-sm:t-w-full t-w-5/6
      t-rounded-sm t-relative
      t-overflow-hidden
    "
    :class="`
        t-shadow-nm-${themeColors.hue}
        t-bg-${themeColors.contentBackgroundPrimary}
        t-text-${themeColors.contentText}
    `">
    <div class="t-inline-flex t-relative t-float-right">
        <code-highlighter-theme-switch
            v-show="codeThemeSwitchVisible"
            :is-dark="isDark"
            :color="color"/>
        <slot />
    </div>
    <content-box
        :is-dark="isDark"
        :color="color"
        :content="content"
        :header-background-name="headerBackgroundName"
        @showCodeThemeSwitch="codeThemeSwitchVisible=true"
        @hideCodeThemeSwitch="codeThemeSwitchVisible=false">
        <div v-if="content.problems && content.problems.length > 0">
            <div v-if="additionalContent.length === 0">
                <input v-model="password" class="t-input t-appearance-none t-rounded-sm
                                t-py-2 t-px-3 t-outline-none t-h-full
                                t-w-2/5 t-border-grey t-border t-text-center t-h-8 t-border t-rounded-lg t-center
                                t-text-sm"/>
                <button @click="fetchProblems" class="t-text-sm t-bg-white t-text-black t-py-2 t-px-4 t-rounded t-m-1 t-border">Więcej</button>
            </div>
                <content-box v-else
                    :is-dark="isDark"
                    :color="color"
                    :content="additionalContent[0]"
                    :header-background-name="headerBackgroundName"
                    @showCodeThemeSwitch="codeThemeSwitchVisible=true"
                    @hideCodeThemeSwitch="codeThemeSwitchVisible=false">
                    <div>
                        <div>
                            <input v-model="solution.link" class="t-input t-appearance-none t-rounded-sm
                                t-py-2 t-px-3 t-outline-none t-h-full
                                t-w-2/5 t-border-grey t-border t-text-center t-h-8 t-border t-rounded-lg t-center
                                t-text-sm"/>
                            <button @click="sendSolution" v-if="!hideSend && (!solution.grade || Number(solution.grade) < 3)" class="t-text-sm t-bg-white t-text-black t-py-2 t-px-4 t-rounded t-m-1 t-border">Wyślij</button>
                        </div>
                        <div class="t-pt-2">
                            Ocena: {{ solution.grade }}
                        </div>
                        <content-box v-if="solution.explanation.content"
                            :is-dark="isDark"
                            :color="color"
                            :content="solution.explanation"
                            :header-background-name="headerBackgroundName"
                            @showCodeThemeSwitch="codeThemeSwitchVisible=true"
                            @hideCodeThemeSwitch="codeThemeSwitchVisible=false"/>
                    </div>
                </content-box>
        </div>
        </content-box>
    <div
        @click="scrollToTop"
        style="width: 20px;height: 35px;display: flex;justify-content: center;align-items: center;
            position: fixed; right: 25px; bottom: 25px; z-index: 1;"
        class="t-no-underline t-float-right t-text-sm t-font-body
         t-text-grey t-px-2 t-rounded-full t-shadow
         hover:t-opacity-100"
        :class="[
            `hover:t-shadow-md-${themeColors.primary}`,
            isDark
                ? `t-bg-gradient-b-${themeColors.primary}-dark t-opacity-75`
                : `t-bg-gradient-t-${themeColors.primary} t-text-white t-opacity-25`
        ]"
        >
        ▲
        </div>
  </div>
</template>

<script>
import axios from 'axios';

import ContentBox from './ContentBox.vue';
import CodeHighlighterThemeSwitch from './Code/CodeHighlighterThemeSwitch.vue';

export default {
  name: 'ContentPage',
  components: {
    ContentBox,
    CodeHighlighterThemeSwitch,
  },
  props: {
    content: { type: Object, default: () => ({}) },
    headerBackgroundName: { type: String, default: 'overcast' },
    endpoint: { type: String, default: '' }
  },
  data() {
    return {
      codeThemeSwitchVisible: false,
      additionalContent: [],
      solution: { link: '', grade: '', explanation: { content: '' } },
      password: '',
      hideSend: false
    };
  },
  methods: {
    scrollToTop() {
      window.scrollTo(0, 0);
    },
    async fetchProblems() {
      try {
        const problemsResponse = this.endpoint
          ? await axios.get(
            `${this.endpoint}/problem/${this.password}`,
          )
          : {};
        if (Array.isArray(problemsResponse.data)
          && problemsResponse.data && problemsResponse.data.length > 0) {
            if (problemsResponse.data[0].topics[0].quests[0].problems.length > 0) {
                this.additionalContent = problemsResponse.data[0].topics[0].quests[0].problems;
                this.solution.link = problemsResponse.data[0].topics[0].quests[0].problems[0].solutions.length > 0 ?
                    problemsResponse.data[0].topics[0].quests[0].problems[0].solutions[0].link : '';
                this.solution.grade = problemsResponse.data[0].topics[0].quests[0].problems[0].solutions.length > 0 ?
                    problemsResponse.data[0].topics[0].quests[0].problems[0].solutions[0].grade : '';
                this.solution.explanation.content = problemsResponse.data[0].topics[0].quests[0].problems[0].solutions.length > 0 ?
                    problemsResponse.data[0].topics[0].quests[0].problems[0].solutions[0]['explanation'] : '';
           } else {
                this.additionalContent = [];
            }
        }
      } catch (ex) {
        this.additionalContent = [];
      }
    },
    async sendSolution() {
        const body = new FormData();
        body.set('link', this.solution.link);
        const solutionResponse = this.endpoint
          ? await axios.post(
            `${this.endpoint}/problem/${this.password}`,
            body
          )
          : {};

        if (solutionResponse.data && solutionResponse.data && solutionResponse.data.success) {
            this.hideSend = true;
        }
        await this.fetchProblems();
    }
  },
};
</script>
