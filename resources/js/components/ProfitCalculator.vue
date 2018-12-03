<template>
    <div class="profit-calculator">
        <div>
            <label>ARK Amount</label>
            <input type="number" v-model="balance" min="1" max="10000000" />
        </div>

        <div>
            <ul>
                <li>
                    <label>Daily Est.</label>
                    <p>{{ daily }} Ѧ</p>
                </li>

                <li>
                    <label>Monthly Est.</label>
                    <p>{{ monthly }} Ѧ</p>
                </li>
            </ul>
        </div>
    </div>
</template>

<script type="text/javascript">
    export default {
        props: {
            pool: {
                type: Number,
                required: true
            },
            share: {
                type: Number,
                required: true
            }
        },
        data () {
            return {
                balance: 1000,
                daily: 0,
                monthly: 0
            }
        },
        watch: {
            balance: function () {
                this.calculate()
            }
        },
        mounted () {
            this.calculate()
        },
        methods: {
            async calculate () {
                const 1e8 = Math.pow(10, 8)

                if (this.balance >= (this.pool / 1e8)) {
                    this.balance = this.pool / 1e8
                }

                const pool = this.pool + (this.balance * 1e8)
                const reward = 2 * (this.share / 100) * 1e8

                const amount = this.balance * 1e8
                const perDay = (reward * amount / pool * 211) / 1e8

                this.daily = perDay.toLocaleString(undefined, {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                })

                this.monthly = (perDay * 30).toLocaleString(undefined, {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                })
            }
        }
    }
</script>
