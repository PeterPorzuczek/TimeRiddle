<template>
  <div>
    <container
        :is-dark="dark"
        :color="theme"
        :header-background-name=
            "patterns[Math.floor(Math.random()*patterns.length)]">
        <div
            v-if="courses.length > 0">
            <top-bar
                :is-dark="dark"
                :color="theme"
                :title="currentCourse.title"
                :links="currentCourse.links"/>
            <side-bar
                :is-dark="dark"
                :color="theme"
                :course="[currentCourse]"
                @select-content="changeCurrentContent"/>
            <main-page>
                <content-page
                    :is-dark="dark"
                    :color="theme"
                    :content="current"
                    :header-background-name=
                        "patterns[Math.floor(Math.random()*patterns.length)]"/>
            </main-page>
        </div>
    </container>
  </div>
</template>

<script>
import axios from 'axios';

import Container from './Navigation/Container.vue';
import SideBar from './Navigation/SideBar.vue';
import TopBar from './Navigation/TopBar.vue';
import MainPage from './Navigation/MainPage.vue';
import ContentPage from './Content/ContentPage.vue';

export default {
  name: 'Board',
  components: {
    Container,
    TopBar,
    SideBar,
    MainPage,
    ContentPage,
  },
  data() {
    return {
      courses: [],
      currentCourse: {},
      currentCourseTopicId: null,
      currentCourseQuestId: null,
      patterns: [
        "overcast",
        "happy-intersection",
        "random-shapes",
        "cutout",
        "death-star",
        "steel-beams",
        "morphing-diamonds",
        "leaf"
      ],
      theme: 'blue',
      dark: false,
    };
  },
  props: {
    refreshRate: { type: Number, default: 20000 },
    courseAbbreviation: { type: String, default: '' },
    coursePassword: { type: String, default: '' },
    courseLearnEndpoint: { type: String, default: '' },

  },
  async created() {
    await this.fetch();
    setInterval(() => this.fetch(), this.refreshRate);
  },
  computed: {
    current() {
      // eslint-disable-next-line
      const current = this.currentCourse && this.currentCourseTopicId
        ? (!this.currentCourseQuestId
          ? this.courses[0].topics
            .find(item => item.id === this.currentCourseTopicId)
          : this.courses[0].topics
            .find(item => item.id === this.currentCourseTopicId).child
            .find(item => item.id === this.currentCourseQuestId))
        : {};
      const result = current
        ? current
        : (() => {
          this.currentCourseTopicId = this.courses[0].topics[0].id;
          this.currentCourseQuestId = null;
          return this.courses[0].topics
            .find(item => item.id === this.currentCourseTopicId);
        })()

      return result;
    },
  },
  methods: {
    async fetch() {
      try {
        const coursesResponse = this.courseLearnEndpoint
          ? await axios.get(
            `${this.courseLearnEndpoint}/${this.courseAbbreviation}/${this.coursePassword}`,
          )
          : {};
        if (Array.isArray(coursesResponse.data)
          && coursesResponse.data && coursesResponse.data.length > 0) {
          const coursesFormatted = this.format(coursesResponse.data);
          this.courses = coursesFormatted;
          // eslint-disable-next-line
          this.currentCourse = this.courses[0];
          this.currentCourseTopicId = !this.currentCourseTopicId ? this.courses[0].topics[0].id : this.currentCourseTopicId;
        }
      } catch (ex) {
        this.courses = [];
      }
    },
    format(response) {
      return JSON.parse(JSON.stringify(response).replace(/"quests":/g, '"child":'));
    },
    changeCurrentContent(item) {
      if (item.content) {
        if (this.current.content !== item.content) {
          this.$root.$emit('reset-view');
        }
        if (item.child) {
          this.currentCourseTopicId = item.id;
          this.currentCourseQuestId = null;
        } else {
          this.currentCourseTopicId = item.topic_id;
          this.currentCourseQuestId = item.id;
        }
      }
    },
  },
};
</script>
