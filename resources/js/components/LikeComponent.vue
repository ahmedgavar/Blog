
 <!--

    1_ reaction summary :function called in blade return object like :
        (love:1) so i use key and value to loop

 -->
<template>
<div>


    <div class="mt-3 d-flex">
         <!--
            show number of reaction next to image of reaction
            v-show="count":means show reaction and count if there is at least one

             -->
        <div

             class="px-1" v-for="(count,reaction) in reaction_Summary"
              :key="reaction"
              v-show="count"

            >
            <img  style="width: 20px;" :src="Image(reaction)" />
            <span class="px-1">{{count}}</span>
        </div>




</div>

    <div class="position-relative">

        <!-- i used v-show and default is false to hide reaction until user enters like -->
        <div
            class="position-absolute border rounded shadow-sm bg-white images"
            style="bottom: 80px;"
            v-show="show_reactions_types"
            >
                <button
                    class="mr-2 btn btn-sm btn-outline-danger font-weight-bold"

                    @click="toggle_reaction(type)"
                      v-for="type in types" :key="type">
                    <img :src="Image(type)">

                </button>


        </div>
            <!-- toggle show reactions on click -->

        <span>
            <button @click="show_reactions_types =! show_reactions_types"

                 class="d-inline mr-2 btn btn-sm btn-outline-primary font-weight-bold like_btn"

                >
                <!--
                    span show reaction that i choose it
                -->
                    <span v-if="auth_reaction">
                        <img :src="Image(auth_reaction)" class="w-25">
                        {{ auth_reaction }}

                    </span>
                    <span v-else>
                        like
                    </span>

            </button>

        </span>
   </div>
</div>
</template>

<script>
import axios from 'axios'

    export default {
        props:['summary','reacted','reactable_type'],
        data(){
            return{
                show_reactions_types:false,
                types:['like','love','haha','angry','sad','wow'],
                reaction_Summary:{...this.summary},
                auth_reaction:this.reacted?this.reacted.type: null,
            }
        },
        methods:
    //    show images
        {
            Image(type){
            return `/assets/reactions/reactions_${type}.png`

        },
        // save reaction
        toggle_reaction(reaction){


            let path=window.location.href+this.reactable_type+'/reaction';
            let old_reaction=this.auth_reaction;

            axios.post(`${path}`,{reaction})
                .then(function (response)
                 {
                        console.log(response);
                 })
                 .catch((error)=>{

                         console.log(error);
                        this.save_reaction(old_reaction,reaction);


            });

            this.show_reactions_types=false;
            this.save_reaction(reaction,old_reaction);





        },
        save_reaction(new_reaction,old_reaction){
            this.resetReactionSummary(new_reaction,old_reaction);
             if(this.auth_reaction===new_reaction){
                this.auth_reaction=null;
                return;
            }
            else{
            this.auth_reaction=new_reaction;


            }


        },
        // if i reacted before,remove this reaction and add new reaction
        resetReactionSummary(new_reaction,old_reaction){

            if(old_reaction){
                this.reaction_Summary[old_reaction]--;
            }
            if(new_reaction  &&new_reaction !==old_reaction){
                if(!this.reaction_Summary[new_reaction]){
                    this.reaction_Summary[new_reaction]=1;
                    return;
                }
                this.reaction_Summary[new_reaction]++;
            }


        }
    }}
</script>
<style>
.images {
   display: flex;
   flex-direction: row;
   margin-right: 200px;
}
.images>button{
    margin-left: 20px;
    width: 50px;

}
.images>button>img{
    width: 50px;
}
.like_btn{

    /* margin-right: ; */
    /* margin-top: 15px; */
}
</style>
